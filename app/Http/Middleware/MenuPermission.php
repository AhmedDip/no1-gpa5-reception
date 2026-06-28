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
    /**
     * Handle an incoming request.
     *
     * Usage in routes:
     *   ->middleware('menu.permission:dashboard.overview,read')
     *   ->middleware('menu.permission:applications.list,create')
     *
     * Permission map:
     *   read   → wsmu_read
     *   create → wsmu_crat
     *   update → wsmu_updt
     *   delete → wsmu_delt
     *   visible → wsmu_vsbl (always checked first)
     *
     * @param string $subMenuKey  The wsmn_ukey value (e.g. 'dashboard.overview')
     * @param string $permission  One of: read, create, update, delete
     */
    public function handle(Request $request, Closure $next, string $subMenuKey, string $permission = 'read'): Response
    {
        $user = Auth::user();


        // No user or no group → deny
        if (!$user || !$user->wmng_id) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        // Find the sub menu by its unique key
        $subMenu = SubMenu::where('wsmn_ukey', $subMenuKey)->first();

        if (!$subMenu) {
            // Sub menu key not found in DB — deny access
            return $this->deny($request, 'পৃষ্ঠাটি বিদ্যমান নেই।');
        }

        // Find the permission row for this user's group + sub menu
        $groupMenu = UserGroupMenu::where('wsmn_id', $subMenu->id)
            ->where('wmng_id', $user->wmng_id)
            ->first();

        // No permission record → deny
        if (!$groupMenu) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        // wsmu_vsbl must be true — this is the visibility gate
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

        // Share permission flags with the view for hiding/showing buttons
        view()->share('currentPermissions', [
            'visible' => $groupMenu->wsmu_vsbl,
            'create'  => $groupMenu->wsmu_crat,
            'read'    => $groupMenu->wsmu_read,
            'update'  => $groupMenu->wsmu_updt,
            'delete'  => $groupMenu->wsmu_delt,
        ]);

        return $next($request);
    }

    /**
     * Return a 403 response — JSON for AJAX, redirect for web.
     */
    private function deny(Request $request, string $message): Response
    {
        return redirect()->route('admin.no-permission')->with('error', $message);
    }
}
