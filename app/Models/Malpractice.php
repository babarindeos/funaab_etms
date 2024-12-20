<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Malpractice extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'exam_schedule_id', 'student_name', 'matric_no', 'message', 'file', 'user_id'];
}
