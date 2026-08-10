<?php

// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentDetail;
use App\Models\ApplicationStatus;
use App\Models\Division;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    /**
     * Main dashboard overview
     */
    public function index()
    {
        $page_content = [
            'page_title' => 'Dashboard Overview',
            'module_name' => 'Dashboard',
            'module_route' => route('admin.dashboard'),
            'sub_module_name' => 'Overview',
        ];

        $statusCounts = StudentDetail::selectRaw('
            COUNT(*) as total,
            SUM(CASE WHEN application_status_id = 1 THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN application_status_id = 6 THEN 1 ELSE 0 END) as approved,
            SUM(CASE WHEN application_status_id = 7 THEN 1 ELSE 0 END) as rejected
        ')
            ->whereHas('user', function ($query) {
                $query->where('lfcl_id', 1);
            })
            ->first();



        $applicationsByBoard = StudentDetail::select('boards.name_bn as name', DB::raw('count(*) as total'))
            ->join('boards', 'student_details.ssc_board_id', '=', 'boards.id')
            ->whereHas('user', function ($query) {
                $query->where('lfcl_id', 1);
            })
            ->groupBy('boards.name_bn')
            ->pluck('total', 'name')
            ->toArray();


        $applicationsByDivision = Division::select('divisions.name_bn as name', DB::raw('count(student_details.id) as total'))
            ->leftJoin('student_details', function ($join) {
                $join->on('divisions.id', '=', 'student_details.division_id')
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereColumn('users.id', '=', 'student_details.user_id')
                            ->where('users.lfcl_id', 1);
                    });
            })
            ->groupBy('divisions.name_bn')
            ->pluck('total', 'name')
            ->toArray();


        $recentApplications = StudentDetail::with(['user', 'applicationStatus', 'board', 'division'])
            ->whereHas('user', function ($query) {
                $query->where('lfcl_id', 1);
            })
            ->latest()
            ->limit(10)
            ->get();


        $statuses = ApplicationStatus::orderBy('order')->get();


        $data = [
            'totalApplications' => (int) $statusCounts->total,
            'pendingApplications' => (int) $statusCounts->pending,
            'approvedApplications' => (int) $statusCounts->approved,
            'rejectedApplications' => (int) $statusCounts->rejected,
            'applicationsByBoard' => $applicationsByBoard,
            'applicationsByDivision' => $applicationsByDivision,
            // 'applicationsByStudentGroup' => $applicationsByStudentGroup,
            'recentApplications' => $recentApplications,
            'statuses' => $statuses,
        ];

        return view('backend.modules.admin.dashboard.index', array_merge(
            compact('page_content'),
            $data
        ));
    }

    /**
     * Statistics page
     */
    public function stats()
    {
        $page_content = [
            'page_title' => 'Statistics',
            'module_name' => 'Dashboard',
            'module_route' => route('admin.dashboard'),
            'sub_module_name' => 'Statistics',
        ];

        // Applications per day (last 30 days)
        $dailyApplications = StudentDetail::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // GPA distribution
        $gpaDistribution = StudentDetail::select('gpa_result', DB::raw('count(*) as total'))
            ->groupBy('gpa_result')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Top districts
        $topDistricts = StudentDetail::select('districts.name_bn as name', DB::raw('count(*) as total'))
            ->join('districts', 'student_details.district_id', '=', 'districts.id')
            ->groupBy('districts.name_bn')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('backend.modules.admin.dashboard.stats', compact(
            'page_content',
            'dailyApplications',
            'gpaDistribution',
            'topDistricts'
        ));
    }

    public function NoPermission()
    {
        $page_content = [
            'page_title' => 'Access Denied',
            'module_name' => 'Dashboard',
            'module_route' => route('admin.dashboard'),
            'sub_module_name' => 'No Permission',
        ];

        return view('backend.modules.admin.dashboard.no-permission', compact('page_content'));
    }
}
