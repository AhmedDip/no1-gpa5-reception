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
    public function __construct(private MenuService $menuService) {}

    /**
     * Main dashboard overview
     */
    public function index()
    {
        $page_content = [
            'page_title'  => 'Dashboard Overview',
            'module_name' => 'Dashboard',
            'module_route' => route('admin.dashboard'),
            'sub_module_name' => 'Overview',
        ];

        // Summary counts
        $totalApplications   = StudentDetail::count();
        $pendingApplications = StudentDetail::where('application_status_id', 1)->count();
        $approvedApplications = StudentDetail::where('application_status_id', 2)->count();
        $rejectedApplications = StudentDetail::where('application_status_id', 3)->count();

        // Applications by board (for chart)
        $applicationsByBoard = StudentDetail::select('boards.name_bn as name', DB::raw('count(*) as total'))
            ->join('boards', 'student_details.ssc_board_id', '=', 'boards.id')
            ->groupBy('boards.name_bn')
            ->pluck('total', 'name')
            ->toArray();

        $applicationsByDivision = Division::select('divisions.name_bn as name', DB::raw('count(student_details.id) as total'))
            ->leftJoin('student_details', 'divisions.id', '=', 'student_details.division_id')
            ->groupBy('divisions.name_bn')
            ->pluck('total', 'name')
            ->toArray();

        // Applications by Student Group
        $applicationsByStudentGroup = StudentDetail::select('student_groups.name_bn as name', DB::raw('count(*) as total'))
            ->join('student_groups', 'student_details.student_group_id', '=', 'student_groups.id')
            ->groupBy('student_groups.name_bn')
            ->pluck('total', 'name')
            ->toArray();

        // Recent 10 applications
        $recentApplications = StudentDetail::with(['user', 'applicationStatus', 'board', 'division'])
            ->latest()
            ->limit(10)
            ->get();

        // All statuses for filter
        $statuses = ApplicationStatus::orderBy('order')->get();

        return view('backend.modules.admin.dashboard.index', compact(
            'page_content',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'applicationsByBoard',
            'applicationsByDivision',
            'applicationsByStudentGroup',
            'recentApplications',
            'statuses'
        ));
    }

    /**
     * Statistics page
     */
    public function stats()
    {
        $page_content = [
            'page_title'  => 'Statistics',
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
            'page_title'  => 'Access Denied',
            'module_name' => 'Dashboard',
            'module_route' => route('admin.dashboard'),
            'sub_module_name' => 'No Permission',
        ];

        return view('backend.modules.admin.dashboard.no-permission', compact('page_content'));
    }
}
