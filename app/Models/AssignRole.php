<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignRole extends Model
{
    use HasFactory;

    // 1. Invigilator - INV
    // 2. Observer - OBS
    // 3. TIMTEC Member - TTC
    // 4. Chief - CHF

    protected $fillable = [ 'staff_role_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
