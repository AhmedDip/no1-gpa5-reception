<?php
// app/Helpers/MenuHelper.php
namespace App\Helpers;

use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;

class MenuHelper
{
    public static function getMenuItems()
    {
        $user = Auth::user();
        if (!$user || !$user->wmng_id) {
            return [];
        }

        $menuService = app(MenuService::class);
        return $menuService->getMenuForUser($user->wmng_id);
    }

    public static function hasPermission($subMenuKey, $permission = 'read')
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        return $user->hasMenuPermission($subMenuKey, $permission);
    }
}
