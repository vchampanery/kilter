<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userfetchlog extends Model
{
    use HasFactory;
    
    protected $table = 'user_fetch_log';
    
    protected $fillable = [
        'user_fetch_id', 'user_id','update_date',
    ];

}
