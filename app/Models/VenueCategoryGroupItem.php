<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueCategoryGroupItem extends Model
{
    use HasFactory;

    protected $fillable = ['venue_category_group_id', 'venue_category_id'];

    public function venue_category()
    {
        return $this->belongsTo(VenueCategory::class, 'venue_category_id', 'id');
    }
}
