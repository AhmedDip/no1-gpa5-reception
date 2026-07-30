<?php
// app/Models/SmsLog.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsLog extends Model
{
   protected $fillable = [
    'student_detail_id',
    'sent_by',
    'mobile',
    'type',
    'message',
    'status',
    'driver',
    'response',
    'client_trans_id',
    'operator_trans_id',
    'raw_response',
];

protected $casts = [
    'raw_response' => 'array',
];

    public function studentDetail(): BelongsTo
    {
        return $this->belongsTo(StudentDetail::class);
    }

    public function sentBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
}
