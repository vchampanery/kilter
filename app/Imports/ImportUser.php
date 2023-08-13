<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dump($row);
        //check email existing
        //add rest info in it
        // if($row[5]){
            $isExist = User::where('email',$row[5])->first();
            // dump($isExist);
            if( $isExist){
            $isExist->mobile = isset($row[4])?$row[4]:null;
            $isExist->strava_link = isset($row[6])?$row[6]:null;
            $isExist->city = isset($row[2])?$row[2]:null;
            $isExist->state = isset($row[3])?$row[3]:null;
            $isExist->chapter = isset($row[7])?$row[7]:null;
            $isExist->save();
            return $isExist;
            }
            // dd($isExist);
        // }
        return null;
        
        // return new User([
        //     'name' => $row[0],
        //     'email' => $row[1],
        //     'password' => bcrypt($row[2]),
        // ]);
    }
}
