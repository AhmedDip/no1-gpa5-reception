<?php
// app/Http/Controllers/OtpVerificationController.php

namespace App\Http\Controllers;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class OtpVerificationController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Show OTP verification page
     */
    public function showVerifyForm()
    {
        $user = Auth::user();
        
        // If already verified, redirect to dashboard
        if ($user->is_mobile_verified) {
            return redirect()->route('student.dashboard')->with('info', 'আপনার মোবাইল নম্বর ইতিমধ্যে যাচাই করা হয়েছে।');
        }

        // Check if OTP already sent and not expired
        $latestOtp = $user->latestOtp;
        if (!$latestOtp || $latestOtp->isExpired() || $latestOtp->is_verified) {
            // Send new OTP
            $result = $this->otpService->generateAndSendOtp($user);
            if (!$result['success']) {
                return redirect()->route('student.dashboard')->with('error', $result['message']);
            }
        }

        return view('frontend.pages.student.otp-verify');
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request)
    {
        // Log the request for debugging
        Log::info('OTP Verification Request', $request->all());
        
        $validator = Validator::make($request->all(), [
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'OTP প্রয়োজন',
            'otp.size' => 'OTP ৬ ডিজিটের হতে হবে',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'আপনি লগইন করেননি। দয়া করে লগইন করুন।'
            ], 401);
        }
        
        // Check if already verified
        if ($user->is_mobile_verified) {
            return response()->json([
                'success' => false,
                'message' => 'মোবাইল নম্বর ইতিমধ্যে যাচাই করা হয়েছে'
            ], 422);
        }

        $result = $this->otpService->verifyOtp($user, $request->otp);

        if ($result['success']) {
            // Check if parent info is provided
            if (!$user->hasParentInfo()) {
                return response()->json([
                    'success' => true,
                    'message' => $result['message'],
                    'redirect' => route('student.dashboard'),
                    'showParentModal' => true
                ]);
            }
            
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'redirect' => route('student.dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 422);
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'আপনি লগইন করেননি।'
            ], 401);
        }
        
        // Check if already verified
        if ($user->is_mobile_verified) {
            return response()->json([
                'success' => false,
                'message' => 'মোবাইল নম্বর ইতিমধ্যে যাচাই করা হয়েছে'
            ], 422);
        }

        $result = $this->otpService->resendOtp($user);

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'test_otp' => app()->environment('local', 'testing') ? session('test_otp') : null
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => $result['message']
        ], 429);
    }

    /**
     * Skip OTP verification (Development only)
     */
    public function skipVerification()
    {
        if (!app()->environment('local', 'testing')) {
            abort(404);
        }

        $user = Auth::user();
        $user->update([
            'is_mobile_verified' => true,
            'mobile_verified_at' => now(),
        ]);

        return redirect()->route('student.dashboard')->with('success', 'OTP যাচাই বাদ দেওয়া হয়েছে (শুধুমাত্র ডেভেলপমেন্ট)');
    }
}