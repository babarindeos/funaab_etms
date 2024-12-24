<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['semester_id', 'name', 'start_date', 'end_date'];

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public function exam_schedule()
    {
        return $this->hasMany(ExamScheduler::class, 'exam_id', 'id');
    }
}
