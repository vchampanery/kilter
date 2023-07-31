<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manualactivity extends Model
{
    use HasFactory;
    
    protected $table = 'manual_activity';
    
    protected $fillable = [
        'manual_activity_id', 'user_id','update_date','distance ','link'
    ];

}
