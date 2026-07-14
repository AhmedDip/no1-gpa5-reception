<?php
// app/Models/UpazilaManagerAssignment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpazilaManagerAssignment extends Model
{
    protected $fillable = [
        'upazila_id',
        'upazila_name',
        'staff_id',
        'user_id',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
