<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    public function handle(Request $request, Closure $next, string $type): Response
    {
        if (!Auth::check()) {
            return redirect()->route('student.login')->with('error', 'দয়া করে লগইন করুন।');
        }

        $user = Auth::user();
        $userType = $user->userType->slug;

        if ($userType !== $type) {
            if ($user->isStudent()) {
                return redirect()->route('student.dashboard')->with('error', 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
            }
            return redirect('/')->with('error', 'আপনার এই পৃষ্ঠা দেখার অনুমতি নেই।');
        }

        return $next($request);
    }
}
