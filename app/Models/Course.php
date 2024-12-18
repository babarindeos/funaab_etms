<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'title', 'code'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function coordinators()
    {
        return $this->hasMany(CourseCoordinator::class, 'course_id', 'id');
    }

    public function enrolment()
    {
        return $this->hasOne(CourseEnrolment::class, 'course_id', 'id');
    }
}
