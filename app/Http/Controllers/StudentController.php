<?php
// app/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use App\Models\Board;
use App\Models\StudentGroup;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // public function home()
    // {
    //     return view('frontend.pages.home');
    // }

    public function dashboard()
    {
        $user = Auth::user();
        $userDetail = $user->userDetail;
        $showParentModal = !$user->hasParentInfo();
        
        return view('frontend.pages.student.dashboard', compact('user', 'userDetail', 'showParentModal'));
    }

    public function updateParentInfo(Request $request)
    {
        $request->validate([
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'tea_stall_name' => 'required|string|max:255',
            'tea_stall_location' => 'required|string',
            'parent_mobile' => 'required|string|max:15',
            'parent_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'father_name.required' => 'পিতার নাম প্রয়োজন',
            'mother_name.required' => 'মাতার নাম প্রয়োজন',
            'tea_stall_name.required' => 'চায়ের দোকানের নাম প্রয়োজন',
            'tea_stall_location.required' => 'চায়ের দোকানের অবস্থান প্রয়োজন',
            'parent_mobile.required' => 'অভিভাবকের মোবাইল নম্বর প্রয়োজন',
        ]);

        $user = Auth::user();
        $userDetail = $user->userDetail;

        $parentPhotoPath = $userDetail->parent_photo;
        if ($request->hasFile('parent_photo')) {
            if ($parentPhotoPath && Storage::disk('public')->exists($parentPhotoPath)) {
                Storage::disk('public')->delete($parentPhotoPath);
            }
            $parentPhotoPath = $request->file('parent_photo')->store('students/parents', 'public');
        }

        $userDetail->update([
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'tea_stall_name' => $request->tea_stall_name,
            'tea_stall_location' => $request->tea_stall_location,
            'parent_mobile' => $request->parent_mobile,
            'parent_photo' => $parentPhotoPath,
            'is_parent_info_provided' => true,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'অভিভাবকের তথ্য সফলভাবে সংরক্ষণ করা হয়েছে!');
    }

    public function editApplication()
    {
        $user = Auth::user();
        $userDetail = $user->userDetail;
        
        $sscBoards = Board::query()->get();
        $studentGroups = StudentGroup::query()->get();
        $divisions = Division::query()->get();
        $districts = District::query()->where('division_id', $userDetail->division_id)->get();
        $upazilas = Upazila::query()->where('district_id', $userDetail->district_id)->get();
        
        return view('frontend.pages.student.edit-application', compact('user', 'userDetail', 'sscBoards', 'studentGroups', 'divisions', 'districts', 'upazilas'));
    }

    public function updateApplication(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_bn' => 'required|string|max:255',
            'ssc_board_id' => 'required|exists:boards,id',
            'student_group_id' => 'required|exists:student_groups,id',
            'roll_number' => 'required|string',
            'registration_number' => 'required|string',
            'gpa_result' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $userDetail = $user->userDetail;

        if ($request->hasFile('student_photo')) {
            if ($userDetail->student_photo && Storage::disk('public')->exists($userDetail->student_photo)) {
                Storage::disk('public')->delete($userDetail->student_photo);
            }
            $studentPhotoPath = $request->file('student_photo')->store('students/photos', 'public');
            $userDetail->student_photo = $studentPhotoPath;
        }

        $userDetail->update([
            'name_en' => $request->name_en,
            'name_bn' => $request->name_bn,
            'ssc_board_id' => $request->ssc_board_id,
            'student_group_id' => $request->student_group_id,
            'roll_number' => $request->roll_number,
            'registration_number' => $request->registration_number,
            'gpa_result' => $request->gpa_result,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
        ]);

        $user->update([
            'name' => $request->name_en,
        ]);

        return redirect()->route('student.dashboard')->with('success', 'আবেদনের তথ্য সফলভাবে আপডেট করা হয়েছে!');
    }

    public function downloadAcknowledgement()
    {
        return back()->with('info', 'একনলজমেন্ট স্লিপ ডাউনলোডের সুবিধা শীঘ্রই যোগ করা হবে।');
    }
    
    // API endpoint for dependent dropdowns
    public function getDistricts($divisionId)
    {
        $districts = District::where('division_id', $divisionId)->where('lfcl_id', 1)->get();
        return response()->json($districts);
    }
    
    public function getUpazilas($districtId)
    {
        $upazilas = Upazila::where('district_id', $districtId)->where('lfcl_id', 1)->get();
        return response()->json($upazilas);
    }
}