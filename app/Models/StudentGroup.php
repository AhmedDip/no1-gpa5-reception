<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'code',
    ];


    public function studentDetails()
    {
        return $this->hasMany(StudentDetail::class);
    }
}
