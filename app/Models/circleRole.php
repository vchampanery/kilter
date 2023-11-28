<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class circleRole extends Model
{
    use HasFactory;
    protected $table = 'circle_role';
    protected $fillable = [
        'id', 'module','name'
    ];
    public static function RoleId($roleName,$module){

        return self::where('name',$roleName)->where('module',$module)->first('id');

    }
}
