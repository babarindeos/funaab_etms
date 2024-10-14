<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementPermissions extends Model
{
    use HasFactory;

    protected $fillable = ['cell_id', 'user_id', 'create'];


    public function cell()
    {
        return $this->belongsTo(Cell::class, 'cell_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
