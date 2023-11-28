<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class circle extends Model
{
    use HasFactory;
    protected $table = 'circle_master';

    protected $fillable = [
        'id', 'name','created_by'
    ];

}
