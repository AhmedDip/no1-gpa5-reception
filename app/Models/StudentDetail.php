<?php
// app/Models/StudentDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentDetail extends Model
{
    protected $table = 'student_details';

    protected $fillable = [
        'user_id',
        'name_en',
        'name_bn',
        'ssc_board_id',
        'student_group_id',
        'roll_number',
        'registration_number',
        'gpa_result',
        'student_photo',
        'division_id',
        'district_id',
        'upazila_id',
        'father_name',
        'mother_name',
        'tea_stall_name',
        'tea_stall_location',
        'parent_mobile',
        'parent_photo',
        'is_parent_info_provided',
        'application_status_id',
        'sms_sent_at',
        'notification_sent',
    ];

    protected $casts = [
        'is_parent_info_provided' => 'boolean',
        'notification_sent'       => 'boolean',
        'sms_sent_at'             => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'ssc_board_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(StudentGroup::class, 'student_group_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function applicationStatus(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id');
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(ApplicationAuditLog::class)->latest();
    }

    // ─── Helpers ─────────────────────────────────────────────────────────────

    public function isApproved(): bool
    {
        return $this->application_status_id === 2;
    }

    public function isRejected(): bool
    {
        return $this->application_status_id === 3;
    }

    public function isPending(): bool
    {
        return $this->application_status_id === 1;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->application_status_id) {
            1 => 'warning',
            2 => 'success',
            3 => 'danger',
            default => 'secondary',
        };
    }

    public function getStatusLabelBnAttribute(): string
    {
        return match ($this->application_status_id) {
            1 => 'অপেক্ষমাণ',
            2 => 'অনুমোদিত',
            3 => 'প্রত্যাখ্যাত',
            default => 'অজানা',
        };
    }
}
