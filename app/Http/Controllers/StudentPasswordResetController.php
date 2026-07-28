<?php
// app/Http/Controllers/StudentPasswordResetController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentPasswordResetController extends Controller
{
    public function __construct(private OtpService $otpService) {}

    public function showForgotForm()
    {
        return view('frontend.pages.student.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
        ], [
            'mobile.required' => 'মোবাইল নম্বর প্রয়োজন',
        ]);


        $user = User::where('mobile', $request->mobile)
            ->where('user_type_id', 1)
            ->first();

        if (!$user) {
            return back()
                ->with('error', 'এই মোবাইল নম্বরে কোনো অ্যাকাউন্ট পাওয়া যায়নি।')
                ->withInput();
        }

        $result = $this->otpService->generateAndSendOtp($user);

        if (!$result['success']) {
            return back()->with('error', $result['message'])->withInput();
        }

        session([
            'password_reset_user_id' => $user->id,
            'password_reset_verified' => false,
        ]);

        return redirect()->route('student.password.reset.otp')
            ->with('success', 'আপনার মোবাইলে OTP পাঠানো হয়েছে।');
    }

    public function showOtpForm()
    {
        if (!session('password_reset_user_id')) {
            return redirect()->route('student.password.forgot');
        }

        $user = User::find(session('password_reset_user_id'));

        if (!$user) {
            session()->forget(['password_reset_user_id', 'password_reset_verified']);
            return redirect()->route('student.password.forgot');
        }

        return view('frontend.pages.student.reset-password-otp', compact('user'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'OTP প্রয়োজন',
            'otp.size' => 'OTP ৬ ডিজিটের হতে হবে',
        ]);

        $userId = session('password_reset_user_id');

        if (!$userId) {
            return redirect()->route('student.password.forgot')
                ->with('error', 'সেশনের মেয়াদ শেষ হয়েছে। আবার চেষ্টা করুন।');
        }

        $user = User::findOrFail($userId);

        $result = $this->otpService->verifyOtp($user, $request->otp, markMobileVerified: false);

        if (!$result['success']) {
            return back()->with('error', $result['message']);
        }

        session(['password_reset_verified' => true]);

        return redirect()->route('student.password.reset')
            ->with('success', 'OTP যাচাই সফল হয়েছে। এখন নতুন পাসওয়ার্ড দিন।');
    }

    public function resendOtp(Request $request)
    {
        $userId = session('password_reset_user_id');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'সেশনের মেয়াদ শেষ হয়েছে। আবার চেষ্টা করুন।',
            ], 401);
        }

        $user = User::findOrFail($userId);
        $result = $this->otpService->resendOtp($user);

        return response()->json($result, $result['success'] ? 200 : 429);
    }

    public function showResetForm()
    {
        if (!session('password_reset_user_id') || !session('password_reset_verified')) {
            return redirect()->route('student.password.forgot');
        }

        return view('frontend.pages.student.reset-password');
    }

    public function resetPassword(Request $request)
    {
        if (!session('password_reset_user_id') || !session('password_reset_verified')) {
            return redirect()->route('student.password.forgot')
                ->with('error', 'সেশনের মেয়াদ শেষ হয়েছে। আবার চেষ্টা করুন।');
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required' => 'পাসওয়ার্ড প্রয়োজন',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে',
            'password.confirmed' => 'পাসওয়ার্ড মিলছে না',
        ]);

        $user = User::findOrFail(session('password_reset_user_id'));
        $user->update(['password' => Hash::make($request->password)]);

        session()->forget(['password_reset_user_id', 'password_reset_verified']);

        return redirect()->route('student.login')
            ->with('success', 'আপনার পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে। এখন লগইন করুন।');
    }
}
