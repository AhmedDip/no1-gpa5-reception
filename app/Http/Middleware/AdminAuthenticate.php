<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'দয়া করে লগইন করুন।');
        }

        $user = Auth::user();

        if ($user->isStudent()) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'আপনার এই পেজে প্রবেশের অনুমতি নেই।');
        }

        if (!$user->wmng_id) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'আপনার অ্যাকাউন্টে কোনো মেনু গ্রুপ নেই।');
        }

        return $next($request);
    }
}
