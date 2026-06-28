<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && !Auth::user()->isStudent()) {
            return redirect()->route('admin.dashboard');
        }

        return view('backend.modules.admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'ইমেইল প্রয়োজন',
            'email.email'       => 'সঠিক ইমেইল দিন',
            'password.required' => 'পাসওয়ার্ড প্রয়োজন',
        ]);

        // Rate limiting
        $throttleKey = Str::lower($request->email).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->with('error', "অনেকবার চেষ্টা করেছেন। {$seconds} সেকেন্ড পরে চেষ্টা করুন।");
        }

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::user();

            // Block students from admin panel
            if ($user->isStudent()) {
                Auth::logout();
                RateLimiter::hit($throttleKey);
                return back()->with('error', 'আপনার এই পেজে প্রবেশের অনুমতি নেই।');
            }

            // Must have a menu group assigned
            if (!$user->wmng_id) {
                Auth::logout();
                return back()->with('error', 'আপনার অ্যাকাউন্টে কোনো মেনু গ্রুপ নেই। অ্যাডমিনের সাথে যোগাযোগ করুন।');
            }

            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'স্বাগতম, '.$user->name.'!');
        }

        RateLimiter::hit($throttleKey);
        return back()->with('error', 'ইমেইল অথবা পাসওয়ার্ড সঠিক নয়।')->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'সফলভাবে লগআউট হয়েছেন।');
    }
}
