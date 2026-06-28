<?php

// app/Http/Middleware/AdminAuthenticate.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * Checks:
     * 1. User is logged in
     * 2. User is NOT a student (user_type_id == 1)
     * 3. User has a menu group assigned (wmng_id)
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Not logged in → redirect to admin login
        if (!Auth::check()) {
            return redirect()->route('admin.login')
                ->with('error', 'দয়া করে লগইন করুন।');
        }

        $user = Auth::user();

        // Students cannot access admin panel
        if ($user->isStudent()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('error', 'আপনার এই পেজে প্রবেশের অনুমতি নেই।');
        }

        // Must have a menu group (role) assigned
        if (!$user->wmng_id) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('error', 'আপনার অ্যাকাউন্টে কোনো মেনু গ্রুপ নেই। অ্যাডমিনের সাথে যোগাযোগ করুন।');
        }

        return $next($request);
    }
}
