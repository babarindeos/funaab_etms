<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    public function venues()
    {
        return $this->hasMany(Venue::class, 'venue_category_id', 'id');
    }

    public function venue_category_group()
    {
        return $this->belongsTo(VenueCategoryGroupItem::class, 'venue_category_id', 'id');
    }
}
