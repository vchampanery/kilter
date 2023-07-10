<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usergoal extends Model
{
    use HasFactory;
    
    protected $table = 'user_goal';
    
    protected $fillable = [
        'user_goal_id', 'user_id','goal','month','year','isActive'
    ];

}
