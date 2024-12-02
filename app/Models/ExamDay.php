<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDay extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'name', 'date'];
}
