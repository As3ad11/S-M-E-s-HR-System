<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeaveBalance extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Profile()
    {
        return $this->belongsTo(PersonalProfile::class, 'user_id', 'user_id');
    }

    public function Leave()
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_id', 'id');
    }
}
