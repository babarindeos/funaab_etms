<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'current'];

    public function semesters()
    {
        return $this->hasMany(Semester::class, 'academic_session_id', 'id');
    }
}
