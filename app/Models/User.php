<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return (in_array($this->role, [1])) ? true : false;
    }

    public function isUser()
    {
        return (!in_array($this->role, [1])) ? true : false;
    }

    public function isEmployer()
    {
        return (in_array($this->role, [2])) ? true : false;
    }

    public function isHigherUp()
    {
        return (in_array($this->role, [1, 2])) ? true : false;
    }

    public function isManagement()
    {
        return (in_array($this->role, [1, 2, 3])) ? true : false;
    }

    public function isManager()
    {
        return (in_array($this->role, [3])) ? true : false;
    }

    public function isEmployee()
    {
        return (in_array($this->role, [4])) ? true : false;
    }

    public function RoleName()
    {
        return $this->hasOne(Role::class, 'role_code', 'role');
    }

    public function Profile()
    {
        return $this->hasOne(PersonalProfile::class, 'user_id', 'id');
    }

    public function Family()
    {
        return $this->hasMany(PersonalFamily::class, 'user_id', 'id');
    }

    public function Experience()
    {
        return $this->hasMany(PersonalExperience::class, 'user_id', 'id');
    }

    public function Education()
    {
        return $this->hasMany(PersonalEducation::class, 'user_id', 'id');
    }

    public function Department()
    {
        return $this->hasOne(UserDepartment::class, 'user_id', 'id');
    }

    public function Salary()
    {
        return $this->hasMany(UserPayslip::class, 'user_id', 'id');
    }

    public function Task()
    {
        return $this->hasMany(UserTask::class, 'user_id', 'id');
    }
}
