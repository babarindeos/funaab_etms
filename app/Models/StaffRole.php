<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffRole extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(AssignRole::class, 'staff_role_id', 'id');
    }
}
