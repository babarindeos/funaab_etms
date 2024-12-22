<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportVenue extends Model
{
    use HasFactory;

    protected $fillable = ['schedule_id', 'venue_id'];

    public function schedule()
    {
        return $this->belongsTo(ExamScheduler::class, 'schedule_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id', 'id');
    }

    

}
