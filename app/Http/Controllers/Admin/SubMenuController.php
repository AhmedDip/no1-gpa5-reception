<?php
// app/Http/Controllers/Admin/SubMenuController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubMenuRequest;
use App\Models\SubMenu;
use App\Models\UserGroupMenu;
use App\Models\WebMenu;
use App\Models\WebMenuGroup;
use App\Services\MenuService;

class SubMenuController extends Controller
{
    public function __construct(private MenuService $menuService) {}

    public function index()
    {
        $subMenus = SubMenu::with('webMenu')->orderBy('wmnu_id')->orderBy('wsmn_oseq')->get();
        $webMenus = WebMenu::orderBy('wmnu_oseq')->get();

        $page_content = [
            'page_title'      => 'Sub Menu Management',
            'module_name'     => 'Settings',
            'module_route'    => route('admin.menu-management.groups.index'),
            'sub_module_name' => 'Sub Menus',
        ];

        return view('backend.modules.admin.menu-management.sub-menus.index', compact('subMenus', 'webMenus', 'page_content'));
    }

    public function store(SubMenuRequest $request)
    {
        $subMenu = SubMenu::create($request->validated());

        // Safety net: a brand-new sub-menu has NO permission row for anyone yet.
        // Without this, the Super Admin (or whoever created it) would be
        // immediately locked out of the menu item they just created, since
        // MenuPermission middleware requires an explicit tl_wsmu row.
        $this->grantAdminFullAccess($subMenu->id);

        $this->menuService->clearMenuCache();

        return response()->json(['success' => true, 'message' => 'সাব-মেনু সফলভাবে তৈরি হয়েছে।']);
    }

    public function update(SubMenuRequest $request, SubMenu $subMenu)
    {
        $subMenu->update($request->validated());

        $this->menuService->clearMenuCache();

        return response()->json(['success' => true, 'message' => 'সাব-মেনু সফলভাবে আপডেট হয়েছে।']);
    }

    public function destroy(SubMenu $subMenu)
    {
        $subMenu->userGroupMenus()->delete();
        $subMenu->delete();

        $this->menuService->clearMenuCache();

        return response()->json(['success' => true, 'message' => 'সাব-মেনু সফলভাবে মুছে ফেলা হয়েছে।']);
    }

    private function grantAdminFullAccess(int $subMenuId): void
    {
        $adminGroup = WebMenuGroup::where('wmng_code', 'ADMIN')->first();

        if (!$adminGroup) {
            return;
        }

        UserGroupMenu::firstOrCreate(
            ['wsmn_id' => $subMenuId, 'wmng_id' => $adminGroup->id],
            [
                'wsmu_vsbl' => true,
                'wsmu_crat' => true,
                'wsmu_read' => true,
                'wsmu_updt' => true,
                'wsmu_delt' => true,
            ]
        );
    }
}
