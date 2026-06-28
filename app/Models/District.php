<?php
// app/Models/District.php

namespace App\Models;

use App\Models\Upazila;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'name',
        'name_bn',
        'code',
        'lfcl_id',
    ];

    protected $casts = [
        'lfcl_id' => 'integer',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function upazilas()
    {
        return $this->hasMany(Upazila::class);
    }

    public function studentDetails()
    {
        return $this->hasMany(StudentDetail::class, 'district_id');
    }
}
