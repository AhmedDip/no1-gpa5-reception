<?php
// app/Http/Middleware/CheckMobileVerified.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMobileVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('student.login')->with('error', 'দয়া করে লগইন করুন।');
        }
        
        if (!$user->is_mobile_verified) {
            return redirect()->route('student.otp.verify')->with('warning', 'ড্যাশবোর্ড দেখার জন্য আপনার মোবাইল নম্বর যাচাই করা আবশ্যক।');
        }
        
        return $next($request);
    }
}