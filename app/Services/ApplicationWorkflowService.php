<?php
// app/Services/ApplicationWorkflowService.php

namespace App\Services;

use App\Models\ApplicationAuditLog;
use App\Models\ApplicationStatus;
use App\Models\StudentDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ApplicationWorkflowService
{
    public function rmApprove(StudentDetail $application, User $rm, ?string $remarks = null): StudentDetail
    {
        if ($application->applicationStatus?->slug !== StudentDetail::STATUS_PENDING) {
            throw new \RuntimeException('আবেদনটি বর্তমানে পেন্ডিং অবস্থায় নেই, তাই RM অনুমোদন করা যাবে না।');
        }

        DB::transaction(function () use ($application, $rm, $remarks) {
            $this->changeStatus(
                application: $application,
                toSlug: StudentDetail::STATUS_APPROVED_BY_RM,
                action: 'rm_approve',
                actor: $rm,
                remarks: $remarks ?: 'রিজিওনাল ম্যানেজার কর্তৃক অনুমোদিত',
            );

            $application->update([
                'rm_reviewed_by' => $rm->id,
                'rm_reviewed_at' => now(),
            ]);
        });

        return $application->fresh();
    }


    public function rmReject(StudentDetail $application, User $rm, string $remarks): StudentDetail
    {
        if ($application->applicationStatus?->slug !== StudentDetail::STATUS_PENDING) {
            throw new \RuntimeException('আবেদনটি বর্তমানে পেন্ডিং অবস্থায় নেই, তাই RM প্রত্যাখ্যান করা যাবে না।');
        }

        DB::transaction(function () use ($application, $rm, $remarks) {
            $this->changeStatus(
                application: $application,
                toSlug: StudentDetail::STATUS_REJECTED_BY_RM,
                action: 'rm_reject',
                actor: $rm,
                remarks: $remarks,
            );

            $application->update([
                'rm_reviewed_by' => $rm->id,
                'rm_reviewed_at' => now(),
            ]);
        });

        return $application->fresh();
    }


    public function wmApprove(StudentDetail $application, User $wm, ?string $remarks = null): StudentDetail
    {
        if ($application->applicationStatus?->slug !== StudentDetail::STATUS_APPROVED_BY_RM) {
            throw new \RuntimeException('RM অনুমোদনের আগে WM অনুমোদন করা যাবে না।');
        }

        DB::transaction(function () use ($application, $wm, $remarks) {
            $this->changeStatus(
                application: $application,
                toSlug: StudentDetail::STATUS_APPROVED_BY_WM,
                action: 'wm_approve',
                actor: $wm,
                remarks: $remarks ?: 'উইং ম্যানেজার কর্তৃক অনুমোদিত',
            );

            $application->update([
                'wm_reviewed_by' => $wm->id,
                'wm_reviewed_at' => now(),
            ]);
        });

        return $application->fresh();
    }


    public function wmReject(StudentDetail $application, User $wm, string $remarks): StudentDetail
    {
        if ($application->applicationStatus?->slug !== StudentDetail::STATUS_APPROVED_BY_RM) {
            throw new \RuntimeException('RM অনুমোদনের আগে WM প্রত্যাখ্যান করা যাবে না।');
        }

        DB::transaction(function () use ($application, $wm, $remarks) {
            $this->changeStatus(
                application: $application,
                toSlug: StudentDetail::STATUS_REJECTED_BY_WM,
                action: 'wm_reject',
                actor: $wm,
                remarks: $remarks ?: 'উইং ম্যানেজার কর্তৃক প্রত্যাখ্যাত',
            );

            $application->update([
                'wm_reviewed_by' => $wm->id,
                'wm_reviewed_at' => now(),
            ]);
        });

        return $application->fresh();
    }


    private function changeStatus(
        StudentDetail $application,
        string $toSlug,
        string $action,
        User $actor,
        string $remarks,
    ): void {
        $previousStatusId = $application->application_status_id;
        $newStatusId       = ApplicationStatus::where('slug', $toSlug)->value('id');

        $application->update(['application_status_id' => $newStatusId]);

        ApplicationAuditLog::create([
            'student_detail_id'  => $application->id,
            'performed_by'       => $actor->id,
            'action'             => $action,
            'remarks'            => $remarks,
            'previous_status_id' => $previousStatusId,
            'new_status_id'      => $newStatusId,
            'ip_address'         => request()->ip(),
        ]);
    }
}
