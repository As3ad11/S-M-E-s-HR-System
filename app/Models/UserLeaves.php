<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLeaves extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function Profile()
    {
        return $this->belongsTo(PersonalProfile::class, 'user_id', 'user_id');
    }

    public function Leave()
    {
        return $this->belongsTo(LeaveCategory::class, 'leave_id', 'id');
    }
}
