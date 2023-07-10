<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stravauserauth extends Model
{
    use HasFactory;
    protected $table = 'stravauser_auth';
    
    protected $fillable = [
        'stravaactivity_id', 'user_id','accessToken','refreshToken','expiresAt','isActive'
    ];
}
