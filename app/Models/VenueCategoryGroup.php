<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VenueCategoryGroup extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    public function venue_categories()
    {
        return $this->hasManyThrough(
            VenueCategory::class, 
            VenueCategoryGroupItem::class, 
            'venue_category_group_id', // Foreign key on VenueCategoryGroupItem
            'id', // Foreign key on VenueCategory
            'id', // Local key on VenueCategoryGroup
            'venue_category_id' // Local key on VenueCategoryGroupItem
        );
    }

    
}
