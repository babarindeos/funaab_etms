<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    use HasFactory;

    protected $fillable = ['cell_type_id', 'parent', 'name', 'code'];

    public function cell_type()
    {
        return $this->belongsTo(CellType::class, 'cell_type_id', 'id');
    }

    public function parent_modal()
    {
        return $this->belongsTo(Cell::class, 'parent', 'id');
    }

    public function users()
    {
        return $this->hasMany(CellUser::class, 'cell_id', 'id');
    }

    
}
