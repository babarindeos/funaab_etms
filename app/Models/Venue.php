<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'venue_type_id', 'venue_category_id', 'student_capacity', 'max_invigilators'];

    public function venue_type()
    {
        return $this->belongsTo(VenueType::class, 'venue_type_id', 'id');
    }

    public function venue_category()
    {
        return $this->belongsTo(VenueCategory::class, 'venue_category_id', 'id');
    }
}
