<?php
// app/Http/Middleware/CheckMobileVerified.php

namespace App\Http\Middleware;

use App\Services\OtpService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMobileVerified
{
   public function __construct(private OtpService $otpService) {}

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('student.login')->with('error', 'দয়া করে লগইন করুন।');
        }

        if (!$user->is_mobile_verified) {
            if ($this->otpService->deleteIfExpired($user)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('student.register')
                    ->with('error', 'নির্ধারিত সময়ের মধ্যে OTP যাচাই না হওয়ায় আপনার নিবন্ধন বাতিল হয়েছে। দয়া করে পুনরায় নিবন্ধন করুন।');
            }

            return redirect()->route('student.otp.verify')
                ->with('warning', 'ড্যাশবোর্ড দেখার জন্য আপনার মোবাইল নম্বর যাচাই করা আবশ্যক।');
        }

        return $next($request);
    }
}
