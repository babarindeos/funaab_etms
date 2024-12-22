<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailUpload extends Model
{
    use HasFactory;

    protected $fillable = ['fileno'];
}
