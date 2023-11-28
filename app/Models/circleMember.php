<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class circleMember extends Model
{
    use HasFactory;
    protected $table = 'circle_member';
    protected $fillable = [
        'id', 'user_id','role_id','circle_id','isActive'
    ];
}
