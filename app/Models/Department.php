<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'name',
        'code'
    ];

    public function college(){
        return $this->belongsTo(College::class, 'college_id', 'id');
    }

    public function staff()
    {
        return $this->hasMany(Staff::class, 'department_id', 'id');
    }

    public function hod()
    {
        return $this->hasOne(Hod::class, 'department_id', 'id');
    }
   
}
