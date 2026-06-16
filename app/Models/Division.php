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

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class, 'division_id');
    }
}