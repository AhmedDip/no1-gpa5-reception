<?php
// app/Models/ApplicationStatus.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicationStatus extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
        'order'
    ];

    public function studentDetails(): HasMany
    {
        return $this->hasMany(StudentDetail::class, 'application_status_id');
    }
}
