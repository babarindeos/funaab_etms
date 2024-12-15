<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCoordinator extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'user_id'];

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
