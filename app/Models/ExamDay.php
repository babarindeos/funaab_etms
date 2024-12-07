<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDay extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'name', 'date'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
