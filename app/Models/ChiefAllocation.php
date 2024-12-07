<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiefAllocation extends Model
{
    use HasFactory;

    protected $fillable = ['academic_session_id', 
                           'semester_id', 
                           'exam_id', 
                           'exam_day_id', 
                           'chief_id', 
                           'venue_category_group_id', 
                           'time_period_id',
                           'user_id'
                          ];

    public function chief()
    {
        return $this->belongsTo(User::class, 'chief_id', 'id');
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
}
