<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDepartment extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function DepartmentName()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
