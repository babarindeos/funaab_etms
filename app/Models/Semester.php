<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['academic_session_id', 'name', 'current'];

    public function academic_session()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id', 'id');
    }
}
