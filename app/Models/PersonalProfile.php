<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function fullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
