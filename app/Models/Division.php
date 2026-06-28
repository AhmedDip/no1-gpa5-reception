<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'code',
        'lfcl_id',
    ];

    protected $casts = [
        'lfcl_id' => 'integer',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function studentDetails()
    {
        return $this->hasMany(StudentDetail::class, 'division_id');
    }
}
