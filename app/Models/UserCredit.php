<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCredit extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function Profile()
    {
        return $this->belongsTo(PersonalProfile::class, 'user_id', 'user_id');
    }

    public function Credit()
    {
        return $this->belongsTo(CreditCategory::class, 'credit_id', 'id');
    }
}
