<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'exam_schedule_id', 'subject', 'message', 'file', 'user_id'];
}
