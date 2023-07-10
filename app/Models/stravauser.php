<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stravauser extends Model
{
    use HasFactory;

    protected $table = 'stravauser';
    
    protected $fillable = [
        'strava_id', 'user_id','username','raw_data'
    ];

}
