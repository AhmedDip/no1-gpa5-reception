<?php
// app/Models/OtpVerification.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobile',
        'otp_code',
        'expires_at',
        'is_verified',
        'verified_at',
        'attempts',
        'last_attempt_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
        'last_attempt_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        return now()->gt($this->expires_at);
    }

    public function isMaxAttemptsReached(): bool
    {
        return $this->attempts >= 5;
    }

    public function canResend(): bool
    {
        return $this->last_attempt_at && $this->last_attempt_at->diffInSeconds(now()) >= 60;
    }
}