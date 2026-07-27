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
use App\Services\ApplicationWorkflowService;
use App\Services\ManagerScopeService;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    public function __construct(
        private NotificationService      $notificationService,
        private ApplicationExportService $exportService,
        private ManagerScopeService      $managerScope,
        private ApplicationWorkflowService $workflowService,
    ) {}

    private function scopeUpazilaIds(): ?array
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return null;
        }

        if ($user->isRegionalManager() || $user->isWingManager()) {
            return $this->managerScope->visibleUpazilaIds($user);
        }

        return [];
    }


    public function index(Request $request)
    {
        $filters    = $request->only(['status', 'board', 'division', 'district', 'search', 'per_page']);
        $upazilaIds = $this->scopeUpazilaIds();

        $query = $this->exportService->buildQuery($filters);
        if ($upazilaIds !== null) {
            $query->whereIn('upazila_id', $upazilaIds);
        }

        $perPage      = $filters['per_page'] ?? 20;
        $applications = $query->paginate($perPage)->withQueryString();

        $countsBase = StudentDetail::query();
        if ($upazilaIds !== null) {
            $countsBase->whereIn('upazila_id', $upazilaIds);
        }

        $counts = [
            'total'          => (clone $countsBase)->count(),
            'pending'        => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_PENDING))->count(),
            'approved_by_rm' => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_APPROVED_BY_RM))->count(),
            'rejected_by_rm' => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_REJECTED_BY_RM))->count(),
            'approved_by_wm' => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_APPROVED_BY_WM))->count(),
            'rejected_by_wm' => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_REJECTED_BY_WM))->count(),
            'approved'       => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_APPROVED))->count(),
            'rejected'       => (clone $countsBase)->whereHas('applicationStatus', fn($q) => $q->where('slug', StudentDetail::STATUS_REJECTED))->count(),
        ];

        $page_content = [
            'page_title'      => 'Applications',
            'module_name'     => 'Applications',
            'module_route'    => route('admin.applications.index'),
            'sub_module_name' => Auth::user()->isAdmin() ? 'All Applications' : 'My Region Applications',
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
        $application = $this->findScoped($id, [
            'user',
            'board',
            'group',
            'division',
            'district',
            'upazila',
            'applicationStatus',
            'rmReviewer',
            'wmReviewer',
            'auditLogs.performedBy',
            'auditLogs.previousStatus',
            'auditLogs.newStatus',
            'smsLogs' => fn($q) => $q->latest(),
        ]);

        $statuses = ApplicationStatus::orderBy('order')->get();

        $page_content = [
            'page_title'      => 'Application Detail',
            'module_name'     => 'Applications',
            'module_route'    => route('admin.applications.index'),
            'sub_module_name' => 'Detail',
        ];

        return view(
            'backend.modules.student.applications.show',
            compact('application', 'statuses', 'page_content')
        );
    }

    public function approve(Request $request, $id)
    {
        // dd($request->all());
        $request->validate(['remarks' => 'nullable|string|max:1000']);

        $user = Auth::user();
        $app  = $this->findScoped($id, ['user']);

        try {
            if ($user->isAdmin()) {
                $approvedStatus = ApplicationStatus::where('slug', 'approved')->value('id') ?? 6;

                if ($app->application_status_id === $approvedStatus) {
                    return $this->jsonOrRedirect($request, false, 'আবেদনটি ইতিমধ্যে অনুমোদিত।');
                }

                DB::transaction(function () use ($app, $approvedStatus, $request) {
                    $previousStatus = $app->application_status_id;
                    $app->update(['application_status_id' => $approvedStatus]);
                    $this->logAction($app->id, 'approve', $request->remarks ?? '', $previousStatus, $approvedStatus, $request->ip());
                });

                $message = 'আবেদন সফলভাবে অনুমোদিত হয়েছে।';

                if ($request->boolean('send_sms', true)) {
                    $this->notificationService->notifyApproved($app->fresh());
                }
            } elseif ($user->isRegionalManager()) {
                $this->workflowService->rmApprove($app, $user, $request->remarks);
                $message = 'আবেদনটি RM কর্তৃক অনুমোদিত হয়েছে।';
            } elseif ($user->isWingManager()) {
                $this->workflowService->wmApprove($app, $user, $request->remarks);
                $message = 'আবেদনটি WM কর্তৃক অনুমোদিত হয়েছে।';
            } else {
                return $this->jsonOrRedirect($request, false, 'আপনার অনুমতি নেই।', 403);
            }
        } catch (\RuntimeException $e) {
            return $this->jsonOrRedirect($request, false, $e->getMessage(), 422);
        } catch (\Exception $e) {
            Log::error('Approve failed: ' . $e->getMessage());
            return $this->jsonOrRedirect($request, false, 'অনুমোদন ব্যর্থ হয়েছে।', 500);
        }

        return $this->jsonOrRedirect($request, true, $message);
    }

    public function reject(Request $request, int $id)
    {
        $user = Auth::user();
        $app  = $this->findScoped($id, ['user']);

        try {
            if ($user->isAdmin()) {
                $rejectedStatus = ApplicationStatus::where('slug', 'rejected')->value('id') ?? 7;

                if ($app->application_status_id === $rejectedStatus) {
                    return $this->jsonOrRedirect($request, false, 'আবেদনটি ইতিমধ্যে প্রত্যাখ্যাত।');
                }

                DB::transaction(function () use ($app, $rejectedStatus, $request) {
                    $previousStatus = $app->application_status_id;
                    $app->update(['application_status_id' => $rejectedStatus]);
                    $this->logAction($app->id, 'reject', $request->remarks, $previousStatus, $rejectedStatus, $request->ip());
                });

                if ($request->boolean('send_sms', true)) {
                    $this->notificationService->notifyRejected($app->fresh(), $request->remarks);
                }
            } elseif ($user->isRegionalManager()) {
                $this->workflowService->rmReject($app, $user, $request->remarks);
            } elseif ($user->isWingManager()) {
                $this->workflowService->wmReject($app, $user, $request->remarks);
            } else {
                return $this->jsonOrRedirect($request, false, 'আপনার অনুমতি নেই।', 403);
            }
        } catch (\RuntimeException $e) {
            return $this->jsonOrRedirect($request, false, $e->getMessage(), 422);
        } catch (\Exception $e) {
            Log::error('Reject failed: ' . $e->getMessage());
            return $this->jsonOrRedirect($request, false, 'প্রত্যাখ্যান ব্যর্থ হয়েছে।', 500);
        }

        return $this->jsonOrRedirect($request, true, 'আবেদন প্রত্যাখ্যাত হয়েছে।');
    }


    public function bulkApprove(Request $request)
    {
        abort_unless(Auth::user()->isAdmin(), 403);
        $request->validate([
            'application_ids'   => 'required|array|min:1|max:200',
            'application_ids.*' => 'integer|exists:student_details,id',
            'remarks'           => 'nullable|string|max:1000',
            'send_sms'          => 'nullable|boolean',
        ], [
            'application_ids.required' => 'কমপক্ষে একটি আবেদন নির্বাচন করুন।',
        ]);

        try {
            DB::beginTransaction();

            $approvedStatus = ApplicationStatus::where('slug', 'approved')->value('id') ?? 6;
            $ids            = $request->application_ids;
            $remarks        = $request->remarks ?: 'বাল্ক অনুমোদন';

            $apps = StudentDetail::with('user')
                ->whereIn('id', $ids)
                ->where('application_status_id', '!=', $approvedStatus)
                ->get();

            foreach ($apps as $app) {
                $previousStatus = $app->application_status_id;
                $app->update(['application_status_id' => $approvedStatus]);
                $this->logAction($app->id, 'bulk_approve', $remarks, $previousStatus, $approvedStatus, $request->ip());
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


    public function bulkNotify(Request $request)
    {
        abort_unless(Auth::user()->isAdmin(), 403);
        $request->validate([
            'application_ids'   => 'required|array|min:1|max:200',
            'application_ids.*' => 'integer|exists:student_details,id',
            'message_type'      => 'required|in:approved,rejected,custom',
            'custom_msg'        => 'required_if:message_type,custom|nullable|string|max:300',
            'remarks'           => 'nullable|string|max:500',
        ], [
            'application_ids.required' => 'কমপক্ষে একটি আবেদন নির্বাচন করুন।',
            'custom_msg.required_if'   => 'কাস্টম মেসেজ লিখুন।',
        ]);

        $apps = StudentDetail::with('user')
            ->whereIn('id', $request->application_ids)
            ->get();

        if ($apps->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'কোনো বৈধ আবেদন পাওয়া যায়নি।'], 422);
        }

        // "rejected" template loop reuses the exact same service method
        // that single reject / bulkReject already use — keeps SMS body consistent.
        if ($request->message_type === 'rejected') {
            $sent = $failed = 0;

            foreach ($apps as $app) {
                $ok = $this->notificationService->notifyRejected($app, $request->remarks ?? '');
                $ok ? $sent++ : $failed++;
                usleep(200000);
            }

            $result = compact('sent', 'failed');
        } else {
            $customMsg = $request->message_type === 'custom' ? $request->custom_msg : '';
            $result    = $this->notificationService->sendBulk($apps->all(), $customMsg);
        }

        // Audit trail — previously missing entirely for bulk notify, so a
        // student's "Activity Timeline" on the show page never reflected it.
        $logRemarks = 'বাল্ক নোটিফিকেশন (' . $request->message_type . ')'
            . ($request->remarks ? ' - ' . $request->remarks : '');

        foreach ($apps as $app) {
            $this->logAction($app->id, 'bulk_notify', $logRemarks, null, null, $request->ip());
        }

        return response()->json([
            'success' => true,
            'message' => "{$result['sent']}টি SMS পাঠানো হয়েছে, {$result['failed']}টি ব্যর্থ।",
            'sent'    => $result['sent'],
            'failed'  => $result['failed'],
        ]);
    }

    public function bulkReject(Request $request)
    {
        abort_unless(Auth::user()->isAdmin(), 403);
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

            $rejectedStatus = ApplicationStatus::where('slug', 'rejected')->value('id') ?? 7;
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
        abort_unless(Auth::user()->isAdmin(), 403);
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


    public function export(Request $request)
    {
        abort_unless(Auth::user()->isAdmin(), 403);
        $filters = $request->only(['status', 'board', 'division', 'district', 'search']);
        return $this->exportService->downloadCsv($filters);
    }


    private function findScoped(int $id, array $with = []): StudentDetail
    {
        $upazilaIds = $this->scopeUpazilaIds();
        $query      = StudentDetail::with($with);

        if ($upazilaIds !== null) {
            $query->whereIn('upazila_id', $upazilaIds);
        }

        return $query->findOrFail($id);
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

    private function jsonOrRedirect(Request $request, bool $success, string $message, ?int $status = null): mixed
    {
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => $success, 'message' => $message], $status ?? ($success ? 200 : 422));
        }

        $type = $success ? 'success' : 'error';
        return redirect()->back()->with($type, $message);
    }
}
