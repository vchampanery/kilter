<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
    
    protected $table = 'review';
    
    protected $fillable = [
        'review_id', 'user_id','review','review_date'
    ];

    public static function getCount(){
        return visitor::count();
    }
}
