<?php
// app/Http/Controllers/Admin/UpazilaManagerAssignmentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpazilaManagerAssignmentRequest;
use App\Models\Upazila;
use App\Models\UpazilaManagerAssignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function export(Request $request): StreamedResponse
    {
        $fileName = 'upazila_manager_assignments_' . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ];

        $query = $this->buildFilteredQuery($request);

        return new StreamedResponse(function () use ($query) {
            $handle = fopen('php://output', 'w');

            if ($handle === false) {
                Log::error('UpazilaManagerAssignmentController: failed to open output stream for CSV export.');
                return;
            }

            // UTF-8 BOM so Excel opens Bangla text correctly
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'SL',
                'Division',
                'District',
                'Upazila',
                'Upazila ID',
                'Staff ID',
                'Staff Name',
                'Role',
                'Supervisor',
                'Staff ID of Supervisor',
            ]);

            $sl = 1;

            try {
                $query->chunk(200, function ($rows) use ($handle, &$sl) {
                    foreach ($rows as $row) {
                        fputcsv($handle, [
                            $sl++,
                            $row->division_name,
                            $row->district_name,
                            $row->upazila_name,
                            $row->upazila_id,
                            $row->staff_id,
                            $row->manager->name ?? '',
                            $row->manager
                                ? ($row->manager->isRegionalManager() ? 'Regional Manager' : 'Wing Manager')
                                : '',
                            $row->manager?->manager?->name ?? '',
                            $row->manager?->manager?->email ?? '',
                        ]);
                    }
                });
            } catch (\Throwable $e) {
                Log::error('UpazilaManagerAssignmentController: CSV export failed mid-stream: ' . $e->getMessage());
            }

            fclose($handle);
        }, 200, $headers);
    }

    /**
     * Shared filter + join logic for both the paginated list and the export,
     * so the two never drift out of sync.
     */
    private function buildFilteredQuery(Request $request): Builder
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

    

        return $query->join('upazilas', 'upazila_manager_assignments.upazila_id', '=', 'upazilas.id')
            ->join('districts', 'upazilas.district_id', '=', 'districts.id')
            ->join('divisions', 'districts.division_id', '=', 'divisions.id')
            ->select(
                'upazila_manager_assignments.*',
                'upazilas.name as upazila_name',
                'districts.name as district_name',
                'divisions.name as division_name'
            )
            ->orderBy('divisions.name')
            ->orderBy('districts.name')
            ->orderBy('upazilas.name');
    }
}
