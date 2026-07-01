<?php
// app/Http/Controllers/Admin/ApplicationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationAuditLog;
use App\Models\ApplicationStatus;
use App\Models\Board;
use App\Models\District;
use App\Models\Division;
use App\Models\StudentDetail;
use App\Services\ApplicationExportService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function __construct(
        private NotificationService    $notificationService,
        private ApplicationExportService $exportService,
    ) {}


    public function index(Request $request)
    {
        $filters = $request->only(['status', 'board', 'division', 'district', 'search', 'per_page']);

        $query = $this->exportService->buildQuery($filters);

        $perPage      = 20;
        $applications = $query->paginate($perPage)->withQueryString();

        $counts = [
            'total'    => StudentDetail::count(),
            'pending'  => StudentDetail::where('application_status_id', 1)->count(),
            'approved' => StudentDetail::where('application_status_id', 2)->count(),
            'rejected' => StudentDetail::where('application_status_id', 3)->count(),
        ];

        $page_content = [
            'page_title'      => 'Applications',
            'module_name'     => 'Applications',
            'module_route'    => route('admin.applications.index'),
            'sub_module_name' => 'All Applications',
        ];

        $boards    = Board::orderBy('name')->get();
        $divisions = Division::orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        $statuses  = ApplicationStatus::orderBy('order')->get();

        return view('backend.modules.student.applications.index', compact(
            'applications',
            'counts',
            'boards',
            'divisions',
            'districts',
            'statuses',
            'filters',
            'page_content'
        ));
    }


    public function show(int $id)
    {
        $application = StudentDetail::with([
            'user',
            'board',
            'group',
            'division',
            'district',
            'upazila',
            'applicationStatus',
            'auditLogs.performedBy',
            'auditLogs.previousStatus',
            'auditLogs.newStatus',
            'smsLogs' => fn($q) => $q->latest(),
        ])->findOrFail($id);

        $statuses = ApplicationStatus::orderBy('order')->get();

        $page_content = [
            'page_title'      => 'Application Detail',
            'module_name'     => 'Applications',
            'module_route'    => route('admin.applications.index'),
            'sub_module_name' => 'Detail',
        ];

        return view(
            'backend.modules.admin.applications.show',
            compact('application', 'statuses', 'page_content')
        );
    }


    public function approve(Request $request, int $id)
    {
        $request->validate(['remarks' => 'nullable|string|max:1000']);

        $app            = StudentDetail::with('user')->findOrFail($id);
        $approvedStatus = ApplicationStatus::where('slug', 'approved')->value('id') ?? 2;

        if ($app->application_status_id === $approvedStatus) {
            return $this->jsonOrRedirect($request, false, 'আবেদনটি ইতিমধ্যে অনুমোদিত।');
        }

        try {
            DB::beginTransaction();

            $previousStatus = $app->application_status_id;
            $app->update(['application_status_id' => $approvedStatus]);

            $this->logAction($app->id, 'approve', $request->remarks ?? '', $previousStatus, $approvedStatus, $request->ip());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Approve failed: ' . $e->getMessage());
            return $this->jsonOrRedirect($request, false, 'অনুমোদন ব্যর্থ হয়েছে।');
        }

        if ($request->boolean('send_sms', true)) {
            $this->notificationService->notifyApproved($app->fresh());
        }

        return $this->jsonOrRedirect($request, true, 'আবেদন সফলভাবে অনুমোদিত হয়েছে।');
    }


    public function reject(Request $request, int $id)
    {
        $request->validate([
            'remarks' => 'required|string|min:5|max:1000',
        ], [
            'remarks.required' => 'প্রত্যাখ্যানের কারণ লিখুন।',
            'remarks.min'      => 'কারণ কমপক্ষে ৫ অক্ষরের হতে হবে।',
        ]);

        $app            = StudentDetail::with('user')->findOrFail($id);
        $rejectedStatus = ApplicationStatus::where('slug', 'rejected')->value('id') ?? 3;

        if ($app->application_status_id === $rejectedStatus) {
            return $this->jsonOrRedirect($request, false, 'আবেদনটি ইতিমধ্যে প্রত্যাখ্যাত।');
        }

        try {
            DB::beginTransaction();

            $previousStatus = $app->application_status_id;
            $app->update(['application_status_id' => $rejectedStatus]);

            $this->logAction($app->id, 'reject', $request->remarks, $previousStatus, $rejectedStatus, $request->ip());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Reject failed: ' . $e->getMessage());
            return $this->jsonOrRedirect($request, false, 'প্রত্যাখ্যান ব্যর্থ হয়েছে।');
        }

        if ($request->boolean('send_sms', true)) {
            $this->notificationService->notifyRejected($app->fresh(), $request->remarks);
        }

        return $this->jsonOrRedirect($request, true, 'আবেদন প্রত্যাখ্যাত হয়েছে।');
    }


    public function bulkApprove(Request $request)
    {
        $request->validate([
            'application_ids'   => 'required|array|min:1|max:200',
            'application_ids.*' => 'integer|exists:student_details,id',
            'send_sms'          => 'nullable|boolean',
        ], [
            'application_ids.required' => 'কমপক্ষে একটি আবেদন নির্বাচন করুন।',
        ]);

        try {
            DB::beginTransaction();

            $approvedStatus = ApplicationStatus::where('slug', 'approved')->value('id') ?? 2;
            $ids            = $request->application_ids;

            $apps = StudentDetail::with('user')
                ->whereIn('id', $ids)
                ->where('application_status_id', '!=', $approvedStatus)
                ->get();

            foreach ($apps as $app) {
                $previousStatus = $app->application_status_id;
                $app->update(['application_status_id' => $approvedStatus]);
                $this->logAction($app->id, 'bulk_approve', 'বাল্ক অনুমোদন', $previousStatus, $approvedStatus, $request->ip());
            }

            DB::commit();

            $smsSent   = 0;
            $smsFailed = 0;

            if ($request->boolean('send_sms', true) && $apps->isNotEmpty()) {
                $result    = $this->notificationService->sendBulk($apps->fresh()->all());
                $smsSent   = $result['sent'];
                $smsFailed = $result['failed'];
            }

            $total   = $apps->count();
            $message = "{$total}টি আবেদন অনুমোদিত হয়েছে।";
            if ($smsSent > 0) {
                $message .= " {$smsSent}টি SMS পাঠানো হয়েছে।";
            }

            return response()->json([
                'success'    => true,
                'message'    => $message,
                'approved'   => $total,
                'sms_sent'   => $smsSent,
                'sms_failed' => $smsFailed,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk approve failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'বাল্ক অনুমোদন ব্যর্থ হয়েছে।'], 500);
        }
    }


    public function bulkReject(Request $request)
    {
        $request->validate([
            'application_ids'   => 'required|array|min:1|max:200',
            'application_ids.*' => 'integer|exists:student_details,id',
            'remarks'           => 'required|string|min:5|max:1000',
            'send_sms'          => 'nullable|boolean',
        ], [
            'application_ids.required' => 'কমপক্ষে একটি আবেদন নির্বাচন করুন।',
            'remarks.required'         => 'প্রত্যাখ্যানের কারণ লিখুন।',
        ]);

        try {
            DB::beginTransaction();

            $rejectedStatus = ApplicationStatus::where('slug', 'rejected')->value('id') ?? 3;
            $ids            = $request->application_ids;

            $apps = StudentDetail::with('user')
                ->whereIn('id', $ids)
                ->where('application_status_id', '!=', $rejectedStatus)
                ->get();

            foreach ($apps as $app) {
                $previousStatus = $app->application_status_id;
                $app->update(['application_status_id' => $rejectedStatus]);
                $this->logAction($app->id, 'bulk_reject', $request->remarks, $previousStatus, $rejectedStatus, $request->ip());
            }

            DB::commit();

            if ($request->boolean('send_sms', false) && $apps->isNotEmpty()) {
                $remarks = $request->remarks;
                foreach ($apps->fresh() as $app) {
                    $this->notificationService->notifyRejected($app, $remarks);
                    usleep(200000);
                }
            }

            return response()->json([
                'success'  => true,
                'message'  => $apps->count() . 'টি আবেদন প্রত্যাখ্যাত হয়েছে।',
                'rejected' => $apps->count(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk reject failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'বাল্ক প্রত্যাখ্যান ব্যর্থ হয়েছে।'], 500);
        }
    }


    public function sendNotification(Request $request, int $id)
    {
        $request->validate([
            'message_type' => 'required|in:approved,rejected,custom',
            'custom_msg'   => 'required_if:message_type,custom|nullable|string|max:300',
            'remarks'      => 'nullable|string|max:500',
        ]);

        $app = StudentDetail::with('user')->findOrFail($id);

        $sent = match ($request->message_type) {
            'approved' => $this->notificationService->notifyApproved($app),
            'rejected' => $this->notificationService->notifyRejected($app, $request->remarks ?? ''),
            'custom'   => $this->notificationService->sendBulk([$app], $request->custom_msg)['sent'] > 0,
            default    => false,
        };

        if ($sent) {
            $this->logAction($app->id, 'notify', 'SMS পাঠানো হয়েছে (' . $request->message_type . ')', null, null, $request->ip());
        }

        return response()->json([
            'success' => $sent,
            'message' => $sent ? 'SMS সফলভাবে পাঠানো হয়েছে।' : 'SMS পাঠাতে ব্যর্থ হয়েছে।',
        ]);
    }


    public function bulkNotify(Request $request)
    {
        $request->validate([
            'application_ids'   => 'required|array|min:1|max:200',
            'application_ids.*' => 'integer|exists:student_details,id',
            'message_type'      => 'required|in:approved,custom',
            'custom_msg'        => 'required_if:message_type,custom|nullable|string|max:300',
        ]);

        $apps = StudentDetail::with('user')
            ->whereIn('id', $request->application_ids)
            ->get()
            ->all();

        $customMsg = $request->message_type === 'custom' ? $request->custom_msg : '';
        $result    = $this->notificationService->sendBulk($apps, $customMsg);

        return response()->json([
            'success' => true,
            'message' => "{$result['sent']}টি SMS পাঠানো হয়েছে, {$result['failed']}টি ব্যর্থ।",
            'sent'    => $result['sent'],
            'failed'  => $result['failed'],
        ]);
    }


    public function export(Request $request)
    {
        $filters = $request->only(['status', 'board', 'division', 'district', 'search']);
        return $this->exportService->downloadCsv($filters);
    }


    private function logAction(
        int $studentDetailId,
        string $action,
        string $remarks,
        ?int $previousStatus,
        ?int $newStatus,
        ?string $ip
    ): void {
        ApplicationAuditLog::create([
            'student_detail_id'  => $studentDetailId,
            'performed_by'       => auth()->id(),
            'action'             => $action,
            'remarks'            => $remarks,
            'previous_status_id' => $previousStatus,
            'new_status_id'      => $newStatus,
            'ip_address'         => $ip,
        ]);
    }

    private function jsonOrRedirect(Request $request, bool $success, string $message): mixed
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => $success, 'message' => $message], $success ? 200 : 422);
        }

        $type = $success ? 'success' : 'error';
        return redirect()->back()->with($type, $message);
    }
}
