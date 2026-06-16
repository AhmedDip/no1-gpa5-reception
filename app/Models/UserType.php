<?php
// app/Models/UserType.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'lfcl_id',
    ];

    protected $casts = [
        'lfcl_id' => 'integer',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}