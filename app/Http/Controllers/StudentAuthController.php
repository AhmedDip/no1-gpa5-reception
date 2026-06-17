<?php
// app/Http/Controllers/StudentAuthController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\Board;
use App\Models\StudentGroup;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentAuthController extends Controller
{
    public function showRegister()
    {
        $sscBoards = Board::query()->get();
        $studentGroups = StudentGroup::query()->get();
        $divisions = Division::query()->get();
        
        return view('frontend.pages.student.register', compact('sscBoards', 'studentGroups', 'divisions'));
    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'mobile' => 'required|string|max:15|unique:users,mobile',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'ssc_board_id' => 'required|exists:boards,id',
            'student_group_id' => 'required|exists:student_groups,id',
            'roll_number' => 'required|string',
            'registration_number' => 'required|string',
            'gpa_result' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name_en.required' => 'ইংরেজিতে নাম প্রয়োজন',
            'name_bn.required' => 'বাংলায় নাম প্রয়োজন',
            'mobile.required' => 'মোবাইল নম্বর প্রয়োজন',
            'mobile.unique' => 'এই মোবাইল নম্বর already রেজিস্ট্রেশন করা হয়েছে',
            'password.required' => 'পাসওয়ার্ড প্রয়োজন',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে',
            'password.confirmed' => 'পাসওয়ার্ড মিলছে না',
            'ssc_board_id.required' => 'এসএসসি বোর্ড নির্বাচন করুন',
            'student_group_id.required' => 'গ্রুপ নির্বাচন করুন',
            'division_id.required' => 'বিভাগ নির্বাচন করুন',
            'district_id.required' => 'জেলা নির্বাচন করুন',
            'upazila_id.required' => 'উপজেলা নির্বাচন করুন',
        ]);

        DB::beginTransaction();
        
        try {
            $studentPhotoPath = null;
            if ($request->hasFile('student_photo')) {
                $studentPhotoPath = $request->file('student_photo')->store('students/photos', 'public');
            }

            $user = User::create([
                'name' => $request->name_en,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_type_id' => 1,
                'is_mobile_verified' => false,
            ]);

            UserDetail::create([
                'user_id' => $user->id,
                'name_en' => $request->name_en,
                'name_bn' => $request->name_bn,
                'ssc_board_id' => $request->ssc_board_id,
                'student_group_id' => $request->student_group_id,
                'roll_number' => $request->roll_number,
                'registration_number' => $request->registration_number,
                'gpa_result' => $request->gpa_result,
                'student_photo' => $studentPhotoPath,
                'division_id' => $request->division_id,
                'district_id' => $request->district_id,
                'upazila_id' => $request->upazila_id,
                'is_parent_info_provided' => false,
                'application_status_id' => 1,
            ]);

            DB::commit();
            Auth::login($user);

            // Generate and send OTP
            $otpService = app('App\Services\OtpService');
            $result = $otpService->generateAndSendOtp($user);

            if ($result['success']) {
                session()->flash('success', 'OTP পাঠানো হয়েছে আপনার মোবাইলে। অনুগ্রহ করে OTP দিয়ে আপনার মোবাইল নম্বর যাচাই করুন।');
            } else {
                session()->flash('error', 'OTP পাঠাতে ব্যর্থ হয়েছে। অনুগ্রহ করে পরে আবার চেষ্টা করুন।');
            }

            return redirect()->route('student.dashboard')->with('success', 'নিবন্ধন সফল হয়েছে! অনুগ্রহ করে আপনার অভিভাবকের তথ্য প্রদান করুন।');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'নিবন্ধন ব্যর্থ হয়েছে! দয়া করে আবার চেষ্টা করুন。')->withInput();
        }
    }

    public function showLogin()
    {
        return view('frontend.pages.student.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required|string',
            'password' => 'required|string',
        ], [
            'mobile.required' => 'মোবাইল নম্বর প্রয়োজন',
            'password.required' => 'পাসওয়ার্ড প্রয়োজন',
        ]);

        $credentials = [
            'mobile' => $request->mobile,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            
            $user = Auth::user();
            
            if (!$user->hasParentInfo()) {
                return redirect()->route('student.dashboard')->with('warning', 'অনুগ্রহ করে আপনার অভিভাবকের তথ্য প্রদান করুন।');
            }
            
            return redirect()->route('student.dashboard')->with('success', 'স্বাগতম! আপনি সফলভাবে লগইন করেছেন।');
        }

        //show toastr error
        return back()->with('error', 'মোবাইল নম্বর অথবা পাসওয়ারড ভুল হয়েছে। দয়া করে আবার চেষ্টা করুন।');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('student.login')->with('success', 'আপনি সফলভাবে লগআউট করেছেন।');
    }
}