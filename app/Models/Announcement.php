<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'cell_id',
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

    public function cell()
    {
        return $this->belongsTo(Cell::class, 'cell_id', 'id');
    }
}
