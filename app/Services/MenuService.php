<?php
// app/Services/MenuService.php
namespace App\Services;

use App\Models\WebMenu;
use App\Models\UserGroupMenu;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    public function getMenuForUser($userGroupId)
    {
        // Cache menu for better performance
        $cacheKey = "user_menu_{$userGroupId}";

        return Cache::remember($cacheKey, 3600, function () use ($userGroupId) {
            $menus = WebMenu::with(['subMenus' => function($query) use ($userGroupId) {
                $query->whereHas('userGroupMenus', function($q) use ($userGroupId) {
                    $q->where('wmng_id', $userGroupId)
                      ->where('wsmu_vsbl', true)
                      ->where('wsmu_read', true);
                });
            }])
            ->where('var', 1)
            ->orderBy('wmnu_oseq')
            ->get();

            return $menus->map(function($menu) {
                return [
                    'id' => $menu->id,
                    'name' => $menu->wmnu_name,
                    'icon' => $menu->wmnu_icon,
                    'sub_menus' => $menu->subMenus->map(function($subMenu) {
                        return [
                            'id' => $subMenu->id,
                            'name' => $subMenu->wsmn_name,
                            'url' => $subMenu->wsmn_wurl,
                            'key' => $subMenu->wsmn_ukey,
                        ];
                    })->values()->toArray()
                ];
            })->filter(function($menu) {
                return !empty($menu['sub_menus']);
            })->values()->toArray();
        });
    }

    public function clearMenuCache($userGroupId = null)
    {
        if ($userGroupId) {
            Cache::forget("user_menu_{$userGroupId}");
        } else {
            // Clear all menu caches
            $userGroups = \App\Models\WebMenuGroup::all();
            foreach ($userGroups as $group) {
                Cache::forget("user_menu_{$group->id}");
            }
        }
    }
}
