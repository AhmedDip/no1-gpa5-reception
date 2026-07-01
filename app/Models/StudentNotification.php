<?php
// app/Models/StudentNotification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentNotification extends Model
{
    protected $fillable = [
        'user_id',
        'student_detail_id',
        'title',
        'message',
        'type',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studentDetail(): BelongsTo
    {
        return $this->belongsTo(StudentDetail::class);
    }

    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }

    public function getIconAttribute(): string
    {
        return match ($this->type) {
            'approved' => 'fa-check-circle text-success',
            'rejected' => 'fa-times-circle text-danger',
            'custom'   => 'fa-envelope text-primary',
            default    => 'fa-bell text-warning',
        };
    }
}