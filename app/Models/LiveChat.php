<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveChat extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'user_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(Staff::class, 'user_id', 'user_id');
    }
}
