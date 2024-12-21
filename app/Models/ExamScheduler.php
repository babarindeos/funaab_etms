<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamScheduler extends Model
{
    use HasFactory;

    protected $fillable = ['academic_session_id', 
                           'semester_id', 
                           'exam_id', 
                           'exam_day_id', 
                           'course_id', 
                           'exam_type_id',
                           'venue_id', 
                           'time_period_id',
                           'user_id'
                          ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function exam_type()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id', 'id');
    }

    public function time_period()
    {
        return $this->belongsTo(ExamTimePeriod::class, 'time_period_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function support_venues()
    {
        return $this->hasMany(SupportVenue::class, 'schedule_id', 'id');
    }
}
