<?php
// app/Http/Controllers/Admin/WebMenuGroupController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebMenuGroupRequest;
use App\Models\WebMenuGroup;
use App\Services\MenuService;

class WebMenuGroupController extends Controller
{
    public function __construct(private MenuService $menuService) {}

    public function index()
    {
        $groups = WebMenuGroup::withCount('users')->orderBy('wmng_name')->get();

        $page_content = [
            'page_title'      => 'User Group (Role) Management',
            'module_name'     => 'Settings',
            'module_route'    => route('admin.menu-management.groups.index'),
            'sub_module_name' => 'User Groups',
        ];

        return view('backend.modules.admin.menu-management.groups.index', compact('groups', 'page_content'));
    }

    public function store(WebMenuGroupRequest $request)
    {
        WebMenuGroup::create($request->validated());

        return response()->json(['success' => true, 'message' => 'গ্রুপ সফলভাবে তৈরি হয়েছে।']);
    }

    public function update(WebMenuGroupRequest $request, WebMenuGroup $group)
    {
        $group->update($request->validated());

        // Group's own visibility/name doesn't affect its permission rows, but

        $this->menuService->clearMenuCache($group->id);

        return response()->json(['success' => true, 'message' => 'গ্রুপ সফলভাবে আপডেট হয়েছে।']);
    }

    public function destroy(WebMenuGroup $group)
    {
        if ($group->users()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'এই গ্রুপে ইউজার অ্যাসাইন করা আছে, তাই মুছে ফেলা যাবে না।',
            ], 422);
        }

        $group->userGroupMenus()->delete();
        $group->delete();

        $this->menuService->clearMenuCache($group->id);

        return response()->json(['success' => true, 'message' => 'গ্রুপ সফলভাবে মুছে ফেলা হয়েছে।']);
    }
}
