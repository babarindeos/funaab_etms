<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'link',
        'file',
        'filesize',
        'filetype',
        'user_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(AnnouncementComment::class, 'announcement_id', 'id');
    }
}
