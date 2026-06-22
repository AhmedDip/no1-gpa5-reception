<?php
// app/Http/Controllers/Admin/ApplicationController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\ApplicationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    /**
     * List all applications with filters
     */
    public function index(Request $request)
    {
        $query = UserDetail::with(['user', 'board', 'group', 'division', 'district', 'upazila', 'applicationStatus']);

        // Apply filters
        if ($request->filled('status')) {
            $query->where('application_status_id', $request->status);
        }

        if ($request->filled('board')) {
            $query->where('ssc_board_id', $request->board);
        }

        if ($request->filled('division')) {
            $query->where('division_id', $request->division);
        }

        if ($request->filled('district')) {
            $query->where('district_id', $request->district);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_en', 'LIKE', "%{$search}%")
                  ->orWhere('name_bn', 'LIKE', "%{$search}%")
                  ->orWhere('roll_number', 'LIKE', "%{$search}%")
                  ->orWhere('registration_number', 'LIKE', "%{$search}%")
                  ->orWhere('father_name', 'LIKE', "%{$search}%")
                  ->orWhere('tea_stall_name', 'LIKE', "%{$search}%");
            });
        }

        $applications = $query->orderBy('created_at', 'desc')->paginate(20);

        // Get filter data
        $boards = \App\Models\Board::all();
        $divisions = \App\Models\Division::all();
        $districts = \App\Models\District::all();
        $statuses = ApplicationStatus::all();

        return view('admin.applications.index', compact(
            'applications',
            'boards',
            'divisions',
            'districts',
            'statuses'
        ));
    }

    /**
     * Show single application details
     */
    public function show($id)
    {
        $application = UserDetail::with([
            'user',
            'board',
            'group',
            'division',
            'district',
            'upazila',
            'applicationStatus'
        ])->findOrFail($id);

        return view('admin.applications.show', compact('application'));
    }

    /**
     * Approve application
     */
    public function approve(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $application = UserDetail::findOrFail($id);
            $application->application_status_id = ApplicationStatus::where('slug', 'approved')->first()->id;
            $application->save();

            // Log the action
            $this->logAction($application->user_id, 'approve', $request->remarks ?? '');

            // Send notification (optional)
            $this->sendNotification($application->user_id, 'approved');

            DB::commit();

            return redirect()->back()->with('success', 'Application approved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Application approval failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to approve application.');
        }
    }

    /**
     * Reject application
     */
    public function reject(Request $request, $id)
    {
        try {
            $request->validate([
                'remarks' => 'required|string|min:10'
            ]);

            DB::beginTransaction();

            $application = UserDetail::findOrFail($id);
            $application->application_status_id = ApplicationStatus::where('slug', 'rejected')->first()->id;
            $application->save();

            // Log the action with remarks
            $this->logAction($application->user_id, 'reject', $request->remarks);

            // Send notification (optional)
            $this->sendNotification($application->user_id, 'rejected', $request->remarks);

            DB::commit();

            return redirect()->back()->with('success', 'Application rejected with remarks.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Application rejection failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to reject application.');
        }
    }

    /**
     * Bulk approve applications
     */
    public function bulkApprove(Request $request)
    {
        try {
            $request->validate([
                'application_ids' => 'required|array|min:1',
                'application_ids.*' => 'exists:user_details,id'
            ]);

            DB::beginTransaction();

            $approvedStatus = ApplicationStatus::where('slug', 'approved')->first()->id;

            UserDetail::whereIn('id', $request->application_ids)
                ->update(['application_status_id' => $approvedStatus]);

            // Log bulk action
            Log::info('Bulk approve', [
                'user_ids' => $request->application_ids,
                'approved_by' => auth()->id()
            ]);

            DB::commit();

            return redirect()->back()->with('success', count($request->application_ids) . ' applications approved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk approve failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to approve applications.');
        }
    }

    /**
     * Export applications to Excel/CSV
     */
    public function export(Request $request)
    {
        // Implement export logic using Laravel Excel or similar package
        // For now, return a simple CSV download
        $applications = UserDetail::with(['user', 'board', 'applicationStatus'])
            ->when($request->status, function($query, $status) {
                return $query->where('application_status_id', $status);
            })
            ->get();

        $csvData = [];
        $csvData[] = ['Name', 'Board', 'Roll', 'GPA', 'Status', 'Tea Stall', 'Submitted At'];

        foreach ($applications as $app) {
            $csvData[] = [
                $app->name_en,
                $app->board->name ?? '',
                $app->roll_number,
                $app->gpa_result,
                $app->applicationStatus->name ?? '',
                $app->tea_stall_name,
                $app->created_at->format('Y-m-d H:i')
            ];
        }

        // Generate CSV download
        // ... implement CSV generation
    }

    /**
     * Log application review actions
     */
    private function logAction($userId, $action, $remarks = '')
    {
        // Create application audit log
        // You can create an application_audits table for tracking
        Log::info('Application ' . $action, [
            'user_id' => $userId,
            'action' => $action,
            'remarks' => $remarks,
            'performed_by' => auth()->id()
        ]);
    }

    /**
     * Send notification to applicant
     */
    private function sendNotification($userId, $status, $remarks = '')
    {
        // Implement notification logic
        // You can use Laravel Notifications or custom SMS/Email service
        // This is a placeholder
        Log::info('Notification sent', [
            'user_id' => $userId,
            'status' => $status,
            'remarks' => $remarks
        ]);
    }
}
