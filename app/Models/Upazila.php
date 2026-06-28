<?php
// app/Models/Upazila.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'name_bn',
        'code',
        'lfcl_id',
    ];

    protected $casts = [
        'lfcl_id' => 'integer',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function studentDetails()
    {
        return $this->hasMany(StudentDetail::class, 'upazila_id');
    }
}
