<?php
// app/Http/Middleware/MenuPermission.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\MenuHelper;

class MenuPermission
{
    public function handle(Request $request, Closure $next, $subMenuKey, $permission = 'read')
    {
        if (!MenuHelper::hasPermission($subMenuKey, $permission)) {
            abort(403, 'You do not have permission to access this resource.');
        }

        return $next($request);
    }
}
