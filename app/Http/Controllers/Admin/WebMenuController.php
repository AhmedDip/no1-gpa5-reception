<?php
// app/Http/Controllers/Admin/WebMenuController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WebMenuRequest;
use App\Models\WebMenu;
use App\Services\MenuService;

class WebMenuController extends Controller
{
    public function __construct(private MenuService $menuService) {}

    public function index()
    {
        $menus = WebMenu::withCount('subMenus')->orderBy('wmnu_oseq')->get();

        $page_content = [
            'page_title'      => 'Menu Management',
            'module_name'     => 'Settings',
            'module_route'    => route('admin.menu-management.groups.index'),
            'sub_module_name' => 'Web Menus',
        ];

        return view('backend.modules.admin.menu-management.web-menus.index', compact('menus', 'page_content'));
    }

    public function store(WebMenuRequest $request)
    {
        dd($request->all());
        WebMenu::create($request->validated());

        $this->menuService->clearMenuCache();

        return response()->json(['success' => true, 'message' => 'মেনু সফলভাবে তৈরি হয়েছে।']);
    }

    public function update(WebMenuRequest $request, WebMenu $menu)
    {
        dd($request->all());
        $menu->update($request->validated());

        $this->menuService->clearMenuCache();

        return response()->json(['success' => true, 'message' => 'মেনু সফলভাবে আপডেট হয়েছে।']);
    }

    public function destroy(WebMenu $menu)
    {
        if ($menu->subMenus()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'এই মেনুর অধীনে সাব-মেনু আছে, তাই মুছে ফেলা যাবে না। আগে সাব-মেনুগুলো মুছুন।',
            ], 422);
        }

        $menu->delete();

        $this->menuService->clearMenuCache();

        return response()->json(['success' => true, 'message' => 'মেনু সফলভাবে মুছে ফেলা হয়েছে।']);
    }
}
