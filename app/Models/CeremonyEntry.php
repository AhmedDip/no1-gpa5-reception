<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CeremonyEntry extends Model
{
    protected $fillable = [
        'student_id',
        'student_detail_id',
        'status',
        'remarks',
        'scanned_at',
    ];

    protected $casts = [
        'scanned_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function studentDetail()
    {
        return $this->belongsTo(StudentDetail::class);
    }

    // Check if already scanned today
    public function scopeScannedToday($query, $studentId)
    {
        return $query->where('student_id', $studentId)
            ->where('status', 'approved')
            ->whereDate('scanned_at', today());
    }
}
