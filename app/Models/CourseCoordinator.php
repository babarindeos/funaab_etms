<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCoordinator extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id'];

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function available()
    {
        return $this->hasOne(AvailabilityList::class, 'user_id', 'user_id');
    }

    public function hod()
    {
        return $this->hasOne(Hod::class, 'user_id', 'user_id');
    }
}
