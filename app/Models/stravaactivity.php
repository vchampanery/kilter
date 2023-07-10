<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stravaactivity extends Model
{
    use HasFactory;

    protected $table = 'stravaactivity';
    
    protected $fillable = [
        'strava_id', 'user_id','username','raw_data'
    ];

}
