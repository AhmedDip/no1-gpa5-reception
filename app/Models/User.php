<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'wmng_id',
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



    public function userType(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function webMenuGroup(): BelongsTo
    {
        return $this->belongsTo(WebMenuGroup::class, 'wmng_id');
    }

    public function userDetail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    // Check if user has permission for a specific menu
    public function hasMenuPermission($subMenuKey, $permission = 'read')
    {
        if (!$this->wmng_id) {
            return false;
        }

        $subMenu = SubMenu::where('wsmn_ukey', $subMenuKey)->first();
        if (!$subMenu) {
            return false;
        }

        $userGroupMenu = UserGroupMenu::where('wsmn_id', $subMenu->id)
            ->where('wmng_id', $this->wmng_id)
            ->first();

        if (!$userGroupMenu) {
            return false;
        }

        if (!$userGroupMenu->wsmu_vsbl) {
            return false;
        }

        switch ($permission) {
            case 'create':
                return $userGroupMenu->wsmu_crat;
            case 'read':
                return $userGroupMenu->wsmu_read;
            case 'update':
                return $userGroupMenu->wsmu_updt;
            case 'delete':
                return $userGroupMenu->wsmu_delt;
            default:
                return false;
        }
    }
}
