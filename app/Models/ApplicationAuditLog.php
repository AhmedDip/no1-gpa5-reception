<?php
// app/Models/ApplicationAuditLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationAuditLog extends Model
{
    protected $fillable = [
        'student_detail_id',
        'performed_by',
        'action',
        'remarks',
        'previous_status_id',
        'new_status_id',
        'ip_address',
    ];

    public function studentDetail(): BelongsTo
    {
        return $this->belongsTo(StudentDetail::class);
    }

    public function performedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performed_by');
    }

    public function previousStatus(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class, 'previous_status_id');
    }

    public function newStatus(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class, 'new_status_id');
    }
}
