<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password',
        'user_type_id',
        'is_mobile_verified',
        'mobile_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'is_mobile_verified' => 'boolean',
    ];

    /**
     * Get the OTP verifications for the user
     */
    public function otpVerifications()
    {
        return $this->hasMany(OtpVerification::class);
    }

    /**
     * Get the latest OTP verification
     */
    public function latestOtp()
    {
        return $this->hasOne(OtpVerification::class)->latest();
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function isStudent()
    {
        return $this->user_type_id == 1;
    }

    public function hasParentInfo()
    {
        return $this->userDetail && $this->userDetail->is_parent_info_provided;
    }

    public function isMobileVerified()
    {
        return $this->is_mobile_verified;
    }
}