<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimtecAllocation extends Model
{
    use HasFactory;

    protected $fillable = ['academic_session_id', 
                           'semester_id', 
                           'exam_id', 
                           'exam_day_id', 
                           'timtec_member_id', 
                           'venue_category_group_id', 
                           'time_period_id',
                           'user_id'
                          ];

    public function timtec_member()
    {
        return $this->belongsTo(User::class, 'timtec_member_id', 'id');
    }

    public function venue_category_group()
    {
        return $this->belongsTo(VenueCategoryGroup::class, 'venue_category_group_id', 'id');
    }

    public function time_period()
    {
        return $this->belongsTo(ExamTimePeriod::class, 'time_period_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function exam_day()
    {
            return $this->belongsTo(ExamDay::class, 'exam_day_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

  
}
