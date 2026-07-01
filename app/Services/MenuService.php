<?php

namespace App\Services;

use App\Models\WebMenu;
use App\Models\UserGroupMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MenuService
{
    public function getMenuForUser(int $userGroupId): array
    {
        $cacheKey = "user_menu_{$userGroupId}";

        return Cache::remember($cacheKey, 3600, function () use ($userGroupId) {

            $menus = WebMenu::with([
                'subMenus' => function ($query) use ($userGroupId) {
                    $query->whereHas('userGroupMenus', function ($q) use ($userGroupId) {
                        $q->where('wmng_id', $userGroupId)
                            ->where('wsmu_vsbl', true);
                    })
                        ->with(['userGroupMenus' => function ($q) use ($userGroupId) {
                            $q->where('wmng_id', $userGroupId);
                        }])
                        ->orderBy('wsmn_oseq');
                },
            ])
                ->where('var', 1)
                ->orderBy('wmnu_oseq')
                ->get();

            $result = [];

            foreach ($menus as $menu) {
                $subMenuItems = [];

                foreach ($menu->subMenus as $subMenu) {
                    $perm = $subMenu->userGroupMenus->first();

                    $subMenuItems[] = [
                        'id'     => $subMenu->id,
                        'name'   => $subMenu->wsmn_name,
                        'url'    => $subMenu->wsmn_wurl,
                        'ukey'   => $subMenu->wsmn_ukey,
                        'can'    => [
                            'create' => $perm?->wsmu_crat ?? false,
                            'read'   => $perm?->wsmu_read ?? false,
                            'update' => $perm?->wsmu_updt ?? false,
                            'delete' => $perm?->wsmu_delt ?? false,
                        ],
                    ];
                }

                if (count($subMenuItems) > 0) {
                    $result[] = [
                        'id'        => $menu->id,
                        'name'      => $menu->wmnu_name,
                        'icon'      => $menu->wmnu_icon,
                        'sub_menus' => $subMenuItems,
                    ];
                }
            }

            return $result;
        });
    }


    public function getPermissionForSubMenu(int $userGroupId, string $subMenuKey): ?array
    {
        $menus = $this->getMenuForUser($userGroupId);

        foreach ($menus as $menu) {
            foreach ($menu['sub_menus'] as $sub) {
                if ($sub['ukey'] === $subMenuKey) {
                    return $sub['can'];
                }
            }
        }

        return null;
    }

    /**
     * Get permission flags for a specific sub-menu key for the current user.
     */
    public function getPermission(string $subMenuKey): array
    {
        $user = Auth::user();
        if (!$user || !$user->wmng_id) {
            return $this->noPermission();
        }

        $can = $this->getPermissionForSubMenu($user->wmng_id, $subMenuKey);

        if (!$can) {
            return $this->noPermission();
        }

        return array_merge(['visible' => true], $can);
    }

    /**
     * Quick boolean check for a specific permission on a sub-menu key.
     */
    public function can(string $subMenuKey, string $action = 'read'): bool
    {
        $perm = $this->getPermission($subMenuKey);
        return $perm[$action] ?? false;
    }

    public function clearMenuCache(?int $userGroupId = null): void
    {
        if ($userGroupId) {
            Cache::forget("user_menu_{$userGroupId}");
            return;
        }

        $groups = \App\Models\WebMenuGroup::pluck('id');
        foreach ($groups as $id) {
            Cache::forget("user_menu_{$id}");
        }
    }

    private function noPermission(): array
    {
        return [
            'visible' => false,
            'create'  => false,
            'read'    => false,
            'update'  => false,
            'delete'  => false,
        ];
    }
}
