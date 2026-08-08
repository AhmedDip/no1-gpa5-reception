<?php
// app/Http/Controllers/Admin/UpazilaManagerAssignmentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpazilaManagerAssignmentRequest;
use App\Models\Upazila;
use App\Models\UpazilaManagerAssignment;
use App\Models\User;
use Illuminate\Http\Request;

class UpazilaManagerAssignmentController extends Controller
{
    public function index(Request $request)
    {
        $query = UpazilaManagerAssignment::query()->with(['manager.manager']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('upazila_name', 'LIKE', "%{$search}%")
                    ->orWhere('staff_id', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $perPage = (int) $request->input('per_page', 100);

        // $assignments = $query->orderBy('upazila_id')->paginate($perPage)->withQueryString();
        //join with district and division tables to get the names of the district and division for each upazila
        $assignments = $query->join('upazilas', 'upazila_manager_assignments.upazila_id', '=', 'upazilas.id')
            ->join('districts', 'upazilas.district_id', '=', 'districts.id')
            ->join('divisions', 'districts.division_id', '=', 'divisions.id')
            ->select('upazila_manager_assignments.*', 'upazilas.name as upazila_name', 'districts.name as district_name', 'divisions.name as division_name')
            ->orderBy('divisions.name')
            ->orderBy('districts.name')
            ->orderBy('upazilas.name')
            ->paginate($perPage)
            ->withQueryString();

        // dd($assignments->toArray());

        // Only Wing Managers / Regional Managers are ever assigned to an upazila.
        $staffUsers = User::whereIn('user_type_id', [3, 4])
            ->with('manager:id,name')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'aemp_mngr']);

        $upazilas = Upazila::orderBy('name')->get(['id', 'name']);

        $page_content = [
            'page_title'      => 'Upazila Manager Assignments',
            'module_name'     => 'Settings',
            'module_route'    => route('admin.upazila-manager-assignments.index'),
            'sub_module_name' => 'Upazila Manager Assignments',
        ];

        return view('backend.modules.admin.upazila-manager-assignments.index', compact(
            'assignments',
            'staffUsers',
            'upazilas',
            'page_content'
        ));
    }

    public function store(UpazilaManagerAssignmentRequest $request)
    {
        $data = $request->validated();
        $data['upazila_name'] = Upazila::whereKey($data['upazila_id'])->value('name');

        UpazilaManagerAssignment::create($data);

        return response()->json(['success' => true, 'message' => 'অ্যাসাইনমেন্ট সফলভাবে তৈরি হয়েছে।']);
    }

    public function update(UpazilaManagerAssignmentRequest $request, UpazilaManagerAssignment $assignment)
    {
        $data = $request->validated();
        $data['upazila_name'] = Upazila::whereKey($data['upazila_id'])->value('name');

        $assignment->update($data);

        return response()->json(['success' => true, 'message' => 'অ্যাসাইনমেন্ট সফলভাবে আপডেট হয়েছে।']);
    }

    public function destroy(UpazilaManagerAssignment $assignment)
    {
        $assignment->delete();

        return response()->json(['success' => true, 'message' => 'অ্যাসাইনমেন্ট সফলভাবে মুছে ফেলা হয়েছে।']);
    }
}
