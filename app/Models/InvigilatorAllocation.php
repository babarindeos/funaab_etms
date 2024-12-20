<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvigilatorAllocation extends Model
{
    use HasFactory;

    protected $fillable = ['academic_session_id', 
                           'semester_id', 
                           'exam_id', 
                           'exam_day_id', 
                           'invigilator_id', 
                           'exam_schedule_id',
                           'venue_id', 
                           'time_period_id',
                           'user_id'
                          ];

        public function invigilator()
        {
            return $this->belongsTo(User::class, 'invigilator_id', 'id');
        }

        public function venue()
        {
            return $this->belongsTo(Venue::class, 'venue_id', 'id');
        }

        public function exam_day()
        {
            return $this->belongsTo(ExamDay::class, 'exam_day_id', 'id');
        }

        public function time_period()
        {
            return $this->belongsTo(ExamTimePeriod::class, 'time_period_id', 'id');
        }

        public function exam()
        {
            return $this->belongsTo(Exam::class, 'exam_id', 'id');
        }

        public function exam_schedule()
        {
            return $this->belongsTo(ExamScheduler::class, 'exam_schedule_id', 'id');
        }
}
