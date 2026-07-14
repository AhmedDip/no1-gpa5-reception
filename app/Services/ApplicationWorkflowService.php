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
    /**
     * @throws \RuntimeException when the transition isn't allowed from the current status
     */
    public function rmApprove(StudentDetail $app, User $rm, ?string $remarks = null): StudentDetail
    {
        $this->assertStatus($app, StudentDetail::STATUS_PENDING, 'আবেদনটি বর্তমানে পেন্ডিং অবস্থায় নেই, তাই RM অনুমোদন করা যাবে না।');

        return $this->transition(
            $app,
            StudentDetail::STATUS_APPROVED_BY_RM,
            'rm_approve',
            $rm,
            $remarks ?: 'রিজিওনাল ম্যানেজার কর্তৃক অনুমোদিত',
            ['rm_reviewed_by' => $rm->id, 'rm_reviewed_at' => now()]
        );
    }

    public function rmReject(StudentDetail $app, User $rm, string $remarks): StudentDetail
    {
        $this->assertStatus($app, StudentDetail::STATUS_PENDING, 'আবেদনটি বর্তমানে পেন্ডিং অবস্থায় নেই, তাই RM প্রত্যাখ্যান করা যাবে না।');

        return $this->transition(
            $app,
            StudentDetail::STATUS_REJECTED,
            'rm_reject',
            $rm,
            $remarks,
            ['rm_reviewed_by' => $rm->id, 'rm_reviewed_at' => now()]
        );
    }

    public function wmApprove(StudentDetail $app, User $wm, ?string $remarks = null): StudentDetail
    {
        $this->assertStatus($app, StudentDetail::STATUS_APPROVED_BY_RM, 'RM অনুমোদনের আগে WM অনুমোদন করা যাবে না।');

        return $this->transition(
            $app,
            StudentDetail::STATUS_APPROVED_BY_WM,
            'wm_approve',
            $wm,
            $remarks ?: 'উইং ম্যানেজার কর্তৃক অনুমোদিত',
            ['wm_reviewed_by' => $wm->id, 'wm_reviewed_at' => now()]
        );
    }

    public function wmReject(StudentDetail $app, User $wm, string $remarks): StudentDetail
    {
        $this->assertStatus($app, StudentDetail::STATUS_APPROVED_BY_RM, 'RM অনুমোদনের আগে WM প্রত্যাখ্যান করা যাবে না।');

        return $this->transition(
            $app,
            StudentDetail::STATUS_REJECTED,
            'wm_reject',
            $wm,
            $remarks,
            ['wm_reviewed_by' => $wm->id, 'wm_reviewed_at' => now()]
        );
    }

    private function assertStatus(StudentDetail $app, string $expectedSlug, string $message): void
    {
        if ($app->applicationStatus?->slug !== $expectedSlug) {
            throw new \RuntimeException($message);
        }
    }

    private function transition(
        StudentDetail $app,
        string $newSlug,
        string $action,
        User $actor,
        string $remarks,
        array $extra = []
    ): StudentDetail {
        $newStatusId      = ApplicationStatus::where('slug', $newSlug)->value('id');
        $previousStatusId = $app->application_status_id;

        DB::transaction(function () use ($app, $newStatusId, $previousStatusId, $action, $actor, $remarks, $extra) {
            $app->update(array_merge(['application_status_id' => $newStatusId], $extra));

            ApplicationAuditLog::create([
                'student_detail_id'  => $app->id,
                'performed_by'       => $actor->id,
                'action'             => $action,
                'remarks'            => $remarks,
                'previous_status_id' => $previousStatusId,
                'new_status_id'      => $newStatusId,
                'ip_address'         => request()->ip(),
            ]);
        });

        return $app->fresh();
    }
}
