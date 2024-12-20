<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementComment extends Model
{
    use HasFactory;

    protected $fillable = ['announcement_id', 'user_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
