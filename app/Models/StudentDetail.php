<?php
// app/Models/StudentDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class StudentDetail extends Model
{
    protected $table = 'student_details';

    const STATUS_PENDING        = 'pending';
    const STATUS_APPROVED_BY_RM = 'approved_by_rm';
    const STATUS_REJECTED_BY_RM = 'rejected_by_rm';
    const STATUS_APPROVED_BY_WM = 'approved_by_wm';
    const STATUS_REJECTED_BY_WM = 'rejected_by_wm';
    const STATUS_APPROVED       = 'approved';
    const STATUS_REJECTED       = 'rejected';

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
        'rm_reviewed_by',
        'rm_reviewed_at',
        'wm_reviewed_by',
        'wm_reviewed_at',
    ];

    protected $casts = [
        'is_parent_info_provided' => 'boolean',
        'notification_sent'       => 'boolean',
        'sms_sent_at'             => 'datetime',
        'rm_reviewed_at'          => 'datetime',
        'wm_reviewed_at'          => 'datetime',
    ];



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




    public function smsLogs(): HasMany
    {
        return $this->hasMany(SmsLog::class);
    }


    public function getStudentPhotoUrlAttribute(): string
    {
        return $this->resolvePhotoUrl($this->student_photo);
    }

    public function getParentPhotoUrlAttribute(): string
    {
        return $this->resolvePhotoUrl($this->parent_photo);
    }

    private function resolvePhotoUrl(?string $path): string
    {
        if ($path && Storage::disk('uploads')->exists($path)) {
            return Storage::disk('uploads')->url($path);
        }

        return asset('images/default-user.png');
    }

    public function rmReviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rm_reviewed_by');
    }

    public function wmReviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wm_reviewed_by');
    }

    public function isApproved(): bool
    {
        return $this->applicationStatus?->slug === self::STATUS_APPROVED;
    }

    public function isRejected(): bool
    {
        return $this->applicationStatus?->slug === self::STATUS_REJECTED;
    }

    public function isPending(): bool
    {
        return $this->applicationStatus?->slug === self::STATUS_PENDING;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->applicationStatus?->slug) {
            self::STATUS_PENDING        => 'warning',
            self::STATUS_APPROVED_BY_RM => 'info',
            self::STATUS_REJECTED_BY_RM => 'danger',
            self::STATUS_APPROVED_BY_WM => 'primary',
            self::STATUS_REJECTED_BY_WM => 'danger',
            self::STATUS_APPROVED       => 'success',
            self::STATUS_REJECTED       => 'danger',
            default                     => 'secondary',
        };
    }

    public function getStatusLabelBnAttribute(): string
    {
        return match ($this->applicationStatus?->slug) {
            self::STATUS_PENDING        => 'অপেক্ষমাণ',
            self::STATUS_APPROVED_BY_RM => 'RM কর্তৃক অনুমোদিত',
            self::STATUS_REJECTED_BY_RM => 'RM কর্তৃক প্রত্যাখ্যাত',
            self::STATUS_APPROVED_BY_WM => 'WM কর্তৃক অনুমোদিত',
            self::STATUS_REJECTED_BY_WM => 'WM কর্তৃক প্রত্যাখ্যাত',
            self::STATUS_APPROVED       => 'অনুমোদিত',
            self::STATUS_REJECTED       => 'প্রত্যাখ্যাত',
            default                     => 'অজানা',
        };
    }
}
