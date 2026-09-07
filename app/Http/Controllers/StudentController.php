<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\District;
use App\Models\Division;
use App\Models\StudentGroup;
use App\Models\StudentNotification;
use App\Models\Upazila;
use App\Services\CertificateService;
use App\Services\NotificationService;
use App\Services\PhotoUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function __construct(
        private PhotoUploadService $photoUploadService,
        private NotificationService $notificationService,
    ) {
    }

    public function home()
    {
        return view('frontend.pages.home');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $studentDetail = $user->studentDetail;
        $showParentModal = !$user->hasParentInfo();

        // dd($studentDetail);

        $unreadNotifCount = StudentNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('frontend.pages.student.dashboard', compact('user', 'studentDetail', 'showParentModal', 'unreadNotifCount'));
    }

    public function updateParentInfo(Request $request)
    {

        $request->validate([
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'tea_stall_name' => 'required|string|max:255',
            'tea_stall_location' => 'required|string',
            'parent_mobile' => ['required', 'regex:/^01\d{9}$/'],
            'parent_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ], [
            'father_name.required' => 'পিতার নাম প্রয়োজন',
            'mother_name.required' => 'মাতার নাম প্রয়োজন',
            'tea_stall_name.required' => 'চায়ের দোকানের নাম প্রয়োজন',
            'tea_stall_location.required' => 'চায়ের দোকানের অবস্থান প্রয়োজন',
            'parent_mobile.required' => 'অভিভাবকের মোবাইল নম্বর প্রয়োজন',
            'parent_mobile.regex' => 'অভিভাবকের মোবাইল নম্বর অবশ্যই ১১ সংখ্যার হতে হবে এবং 01 দিয়ে শুরু হতে হবে।',
            'parent_photo.required' => 'অভিভাবকের ছবি প্রয়োজন',
            'parent_photo.image' => 'অভিভাবকের ছবি অবশ্যই একটি ইমেজ ফাইল হতে হবে',
            'parent_photo.mimes' => 'অভিভাবকের ছবি অবশ্যই jpeg, png, jpg ফরম্যাটে হতে হবে',
            'parent_photo.max' => 'অভিভাবকের ছবির আকার 5MB এর বেশি হতে পারবে না',
        ]);

        $user = Auth::user();
        $studentDetail = $user->studentDetail;

        $parentPhotoPath = $studentDetail->parent_photo;
        if ($request->hasFile('parent_photo')) {
            $this->photoUploadService->delete($parentPhotoPath);
            $parentPhotoPath = $this->photoUploadService->store(
                $request->file('parent_photo'),
                $user->mobile,
                'students/parents'
            );
        }

        $studentDetail->update([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'tea_stall_name' => $request->tea_stall_name,
            'tea_stall_location' => $request->tea_stall_location,
            'parent_mobile' => $request->parent_mobile,
            'parent_photo' => $parentPhotoPath,
            'is_parent_info_provided' => true,
        ]);

        $this->notificationService->notifyRegistrationComplete($user);

        return redirect()->route('student.dashboard')->with('success', 'অভিভাবকের তথ্য সফলভাবে সংরক্ষণ করা হয়েছে!');
    }

    public function editApplication()
    {
        $user = Auth::user();
        $studentDetail = $user->studentDetail;

        $sscBoards = Board::query()->get();
        $studentGroups = StudentGroup::query()->get();
        $divisions = Division::query()->get();
        $districts = District::query()->where('division_id', $studentDetail->division_id)->get();
        $upazilas = Upazila::query()->where('district_id', $studentDetail->district_id)->get();

        return view('frontend.pages.student.edit-application', compact('user', 'studentDetail', 'sscBoards', 'studentGroups', 'divisions', 'districts', 'upazilas'));
    }

    public function updateApplication(Request $request)
    {
        $messages = [
            'name_en.required' => 'ইংরেজি নাম ক্ষেত্রটি পূরণ করা আবশ্যক।',
            'name_en.string' => 'ইংরেজি নাম অবশ্যই একটি স্ট্রিং হতে হবে।',
            'name_en.max' => 'ইংরেজি নাম সর্বোচ্চ ২৫৫ অক্ষর হতে পারে।',

            'name_bn.required' => 'বাংলা নাম ক্ষেত্রটি পূরণ করা আবশ্যক।',
            'name_bn.string' => 'বাংলা নাম অবশ্যই একটি স্ট্রিং হতে হবে।',
            'name_bn.max' => 'বাংলা নাম সর্বোচ্চ ২৫৫ অক্ষর হতে পারে।',

            'ssc_board_id.required' => 'এসএসসি বোর্ড নির্বাচন করা আবশ্যক।',
            'ssc_board_id.exists' => 'নির্বাচিত বোর্ডটি সঠিক নয়।',

            'student_group_id.required' => 'গ্রুপ নির্বাচন করা আবশ্যক।',
            'student_group_id.exists' => 'নির্বাচিত গ্রুপটি সঠিক নয়।',

            'roll_number.required' => 'রোল নম্বর ক্ষেত্রটি পূরণ করা আবশ্যক।',
            'roll_number.string' => 'রোল নম্বর অবশ্যই একটি স্ট্রিং হতে হবে।',
            'roll_number.regex' => 'রোল নম্বর শুধুমাত্র সংখ্যা হতে পারে।',

            'registration_number.required' => 'রেজিস্ট্রেশন নম্বর ক্ষেত্রটি পূরণ করা আবশ্যক।',
            'registration_number.string' => 'রেজিস্ট্রেশন নম্বর অবশ্যই একটি স্ট্রিং হতে হবে।',
            'registration_number.regex' => 'রেজিস্ট্রেশন নম্বর শুধুমাত্র সংখ্যা হতে পারে।',

            'gpa_result.required' => 'জিপিএ/ফলাফল ক্ষেত্রটি পূরণ করা আবশ্যক।',
            'gpa_result.numeric' => 'জিপিএ অবশ্যই একটি সংখ্যা হতে হবে।',
            'gpa_result.between' => 'জিপিএ ৫ এর মধ্যে হতে হবে।',

            'division_id.required' => 'বিভাগ নির্বাচন করা আবশ্যক।',
            'division_id.exists' => 'নির্বাচিত বিভাগটি সঠিক নয়।',

            'district_id.required' => 'জেলা নির্বাচন করা আবশ্যক।',
            'district_id.exists' => 'নির্বাচিত জেলাটি সঠিক নয়।',

            'upazila_id.required' => 'উপজেলা নির্বাচন করা আবশ্যক।',
            'upazila_id.exists' => 'নির্বাচিত উপজেলাটি সঠিক নয়।',

            'student_photo.image' => 'ছবিটি অবশ্যই একটি চিত্র ফাইল হতে হবে।',
            'student_photo.mimes' => 'ছবিটি অবশ্যই jpeg, png, অথবা jpg ফরম্যাটের হতে হবে।',
            'student_photo.max' => 'ছবির সাইজ সর্বোচ্চ ৫ এমবি হতে পারে।',
        ];

        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'ssc_board_id' => 'required|exists:boards,id',
            'student_group_id' => 'required|exists:student_groups,id',
            'roll_number' => 'required|string|regex:/^[0-9]+$/|max:10',
            'registration_number' => 'required|string|regex:/^[0-9]+$/|max:15',
            'gpa_result' => 'required|numeric|between:0,5',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        $user = Auth::user();
        $studentDetail = $user->studentDetail;

        if ($request->hasFile('student_photo')) {
            if ($studentDetail->student_photo) {
                $this->photoUploadService->delete($studentDetail->student_photo);
            }
            $studentDetail->student_photo = $this->photoUploadService->store(
                $request->file('student_photo'),
                $user->mobile,
                'students/photos'
            );
        }

        $studentDetail->update([
            'name_en' => $validated['name_en'],
            'name_bn' => $validated['name_bn'],
            'ssc_board_id' => $validated['ssc_board_id'],
            'student_group_id' => $validated['student_group_id'],
            'roll_number' => $validated['roll_number'],
            'registration_number' => $validated['registration_number'],
            'gpa_result' => $validated['gpa_result'],
            'division_id' => $validated['division_id'],
            'district_id' => $validated['district_id'],
            'upazila_id' => $validated['upazila_id'],
        ]);

        $user->update([
            'name' => $validated['name_en'],
        ]);

        return redirect()->route('student.dashboard')->with('success', 'আবেদনের তথ্য সফলভাবে আপডেট করা হয়েছে!');
    }

    public function downloadAcknowledgement()
    {
        return back()->with('info', 'একনলজমেন্ট স্লিপ ডাউনলোডের সুবিধা শীঘ্রই যোগ করা হবে।');
    }

    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->get();
        return response()->json($districts);
    }

    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('district_id', $districtId)->get();
        return response()->json($upazilas);
    }

    public function certificate()
    {
        $user = Auth::user();

       if ($user?->studentDetail?->application_status_id != 6) {
            return back()->with('error', 'আপনি এখনও সার্টিফিকেট ডাউনলোডের জন্য যোগ্য নন।');
        }
        $name = Auth::user()->studentDetail->name ?? Auth::user()->name;
        return view('frontend.pages.certificate.index', compact('name', 'user'));
    }

    public function downloadCertificate()
    {
        $user = Auth::user();


         if ($user?->studentDetail?->application_status_id != 6) {
            return back()->with('error', 'আপনি এখনও সার্টিফিকেট ডাউনলোডের জন্য যোগ্য নন।');
        }

        return (new CertificateService())->downloadCertificate();
    }

    public function downloadInvitation()
    {
        $user = Auth::user();

        if (!$user?->studentDetail) {
            return back()->with('error', 'Student details not found');
        }

        return (new InvitationLetterService())->downloadInvitation();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed', 'different:current_password'],
        ], [
            'current_password.required' => 'বর্তমান পাসওয়ার্ড প্রয়োজন',
            'current_password.current_password' => 'বর্তমান পাসওয়ার্ড সঠিক নয়',
            'new_password.required' => 'নতুন পাসওয়ার্ড প্রয়োজন',
            'new_password.min' => 'নতুন পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে',
            'new_password.confirmed' => 'নতুন পাসওয়ার্ড মিলছে না',
            'new_password.different' => 'নতুন পাসওয়ার্ড আগের পাসওয়ার্ড থেকে ভিন্ন হতে হবে',
        ]);

        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'আপনার পাসওয়ার্ড সফলভাবে পরিবর্তন করা হয়েছে!');
    }
}
