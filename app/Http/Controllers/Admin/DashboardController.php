<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalApplications = UserDetail::count();
        $pendingApplications = UserDetail::where('application_status_id', 1)->count();
        $approvedApplications = UserDetail::where('application_status_id', 3)->count();
        $rejectedApplications = UserDetail::where('application_status_id', 4)->count();

        // Chart data
        $applicationsByBoard = UserDetail::select('boards.name', DB::raw('count(*) as total'))
            ->join('boards', 'user_details.ssc_board_id', '=', 'boards.id')
            ->groupBy('boards.name')
            ->pluck('total', 'name')
            ->toArray();

        $recentApplications = UserDetail::with(['user', 'applicationStatus'])
            ->latest()
            ->limit(10)
            ->get();

        return view('backend.layouts.admin-dashboard.index', compact(
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'applicationsByBoard',
            'recentApplications'
        ));
    }
}
