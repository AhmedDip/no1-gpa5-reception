<?php

// app/Http/Middleware/MenuPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubMenu;
use App\Models\UserGroupMenu;
use Symfony\Component\HttpFoundation\Response;

class MenuPermission
{
    public function handle(Request $request, Closure $next, string $subMenuKey, string $permission = 'read'): Response
    {
        $user = Auth::user();


        if (!$user || !$user->wmng_id) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        $subMenu = SubMenu::where('wsmn_ukey', $subMenuKey)->first();

        if (!$subMenu) {
            return $this->deny($request, 'পৃষ্ঠাটি বিদ্যমান নেই।');
        }

        $groupMenu = UserGroupMenu::where('wsmn_id', $subMenu->id)
            ->where('wmng_id', $user->wmng_id)
            ->first();

        if (!$groupMenu) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }


        if (!$groupMenu->wsmu_vsbl) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        // Check the specific permission
        $allowed = match ($permission) {
            'create' => $groupMenu->wsmu_crat,
            'update' => $groupMenu->wsmu_updt,
            'delete' => $groupMenu->wsmu_delt,
            'read'   => $groupMenu->wsmu_read,
            default  => false,
        };

        if (!$allowed) {
            return $this->deny($request, "আপনার এই অপারেশনের ({$permission}) অনুমতি নেই।");
        }

        view()->share('currentPermissions', [
            'visible' => $groupMenu->wsmu_vsbl,
            'create'  => $groupMenu->wsmu_crat,
            'read'    => $groupMenu->wsmu_read,
            'update'  => $groupMenu->wsmu_updt,
            'delete'  => $groupMenu->wsmu_delt,
        ]);

        return $next($request);
    }


    private function deny(Request $request, string $message): Response
    {
        return redirect()->route('admin.no-permission')->with('error', $message);
    }
}
