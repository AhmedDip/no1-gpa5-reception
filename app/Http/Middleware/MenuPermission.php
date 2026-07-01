<?php

// app/Http/Middleware/MenuPermission.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MenuService;
use Symfony\Component\HttpFoundation\Response;

class MenuPermission
{
    public function __construct(private MenuService $menuService) {}

    public function handle(Request $request, Closure $next, string $subMenuKey, string $permission = 'read'): Response
    {
        $user = Auth::user();

        if (!$user || !$user->wmng_id) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        $can = $this->menuService->getPermissionForSubMenu($user->wmng_id, $subMenuKey);

        if (!$can) {
            return $this->deny($request, 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        $allowed = match ($permission) {
            'create' => $can['create'],
            'update' => $can['update'],
            'delete' => $can['delete'],
            'read'   => $can['read'],
            default  => false,
        };

        if (!$allowed) {
            return $this->deny($request, "আপনার এই অপারেশনের ({$permission}) অনুমতি নেই।");
        }

        view()->share('currentPermissions', array_merge(['visible' => true], $can));

        return $next($request);
    }

    private function deny(Request $request, string $message): Response
    {
        return redirect()->route('admin.no-permission')->with('error', $message);
    }
}