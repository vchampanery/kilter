<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class visitor extends Model
{
    use HasFactory;
    
    protected $table = 'visitor';
    
    protected $fillable = [
        'visitor_id', 'visitor_date','ip_address'
    ];

    public static function getCount(){
        return visitor::count();
    }
}
