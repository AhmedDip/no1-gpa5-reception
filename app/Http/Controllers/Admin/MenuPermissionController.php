<?php
// app/Http/Controllers/Admin/MenuPermissionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserGroupMenu;
use App\Models\WebMenu;
use App\Models\WebMenuGroup;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuPermissionController extends Controller
{
    public function __construct(private MenuService $menuService) {}

    public function index()
    {
        $groups = WebMenuGroup::withCount('userGroupMenus')->orderBy('wmng_name')->get();

        $page_content = [
            'page_title'      => 'User Group Permissions',
            'module_name'     => 'Settings',
            'module_route'    => route('admin.menu-management.groups.index'),
            'sub_module_name' => 'Permissions',
        ];

        return view('backend.modules.admin.menu-management.permissions.index', compact('groups', 'page_content'));
    }

    public function edit(WebMenuGroup $group)
    {
        $menus = WebMenu::with(['subMenus' => fn($q) => $q->orderBy('wsmn_oseq')])
            ->orderBy('wmnu_oseq')
            ->get();

        $existingPermissions = UserGroupMenu::where('wmng_id', $group->id)
            ->get()
            ->keyBy('wsmn_id');

        $page_content = [
            'page_title'      => 'Manage Permissions: ' . $group->wmng_name,
            'module_name'     => 'Settings',
            'module_route'    => route('admin.menu-management.groups.index'),
            'sub_module_name' => 'Permissions',
        ];

        return view('backend.modules.admin.menu-management.permissions.edit', compact(
            'group', 'menus', 'existingPermissions', 'page_content'
        ));
    }

    /**
     * Persist the whole permission matrix for one group in a single request.
     * `submenu_ids[]` (hidden inputs, one per row) guarantees that unchecking
     * ALL boxes on a row still revokes access, instead of silently skipping it.
     */
    public function update(Request $request, WebMenuGroup $group)
    {
        $request->validate([
            'submenu_ids'   => ['required', 'array'],
            'submenu_ids.*' => ['integer', 'exists:tm_wsmn,id'],
        ]);

        DB::transaction(function () use ($request, $group) {
            foreach ($request->submenu_ids as $subMenuId) {
                $flags = $request->input("permissions.{$subMenuId}", []);

                UserGroupMenu::updateOrCreate(
                    ['wsmn_id' => $subMenuId, 'wmng_id' => $group->id],
                    [
                        'wsmu_vsbl' => (bool) ($flags['visible'] ?? false),
                        'wsmu_crat' => (bool) ($flags['create'] ?? false),
                        'wsmu_read' => (bool) ($flags['read'] ?? false),
                        'wsmu_updt' => (bool) ($flags['update'] ?? false),
                        'wsmu_delt' => (bool) ($flags['delete'] ?? false),
                    ]
                );
            }
        });

        $this->menuService->clearMenuCache($group->id);

        return redirect()
            ->route('admin.menu-management.permissions.edit', $group)
            ->with('success', 'পারমিশন সফলভাবে সংরক্ষণ করা হয়েছে।');
    }
}
