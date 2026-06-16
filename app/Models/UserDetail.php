<?php
// app/Models/UserDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_details';

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
    ];

    protected $casts = [
        'is_parent_info_provided' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sscBoard()
    {
        return $this->belongsTo(Board::class);
    }

    public function studentGroup()
    {
        return $this->belongsTo(StudentGroup::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

}