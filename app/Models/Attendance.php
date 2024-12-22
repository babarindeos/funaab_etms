<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['academic_session_id', 'semester_id', 'exam_id', 'exam_day_id', 
                           'invigilator_id', 'invigilator_allocation_id', 'supervisor_allocation_id',
                           'venue_id', 'time_period_id', 'supervisor_id', 'attendance', 
                           'attendance_amount', 'attendance_point'];
           
}
