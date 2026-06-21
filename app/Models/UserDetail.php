<?php
// app/Models/UserDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = [
        'user_id', 'name_en', 'name_bn', 'ssc_board_id', 'student_group_id',
        'roll_number', 'registration_number', 'gpa_result', 'student_photo',
        'division_id', 'district_id', 'upazila_id', 'father_name', 'mother_name',
        'tea_stall_name', 'tea_stall_location', 'parent_mobile', 'parent_photo',
        'is_parent_info_provided', 'application_status_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'ssc_board_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(StudentGroup::class, 'student_group_id');
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    public function applicationStatus(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class, 'application_status_id');
    }
}
