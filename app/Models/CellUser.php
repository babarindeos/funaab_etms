<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CellUser extends Model
{
    use HasFactory;

    protected $fillable = ['cell_id', 'user_id', 'role'];

    public function cell()
    {
        return $this->belongsTo(Cell::class, 'cell_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function announcement_permission()
    {
        return $this->hasMany(AnnouncementPermissions::class, 'cell_id', 'id');
    }
}
