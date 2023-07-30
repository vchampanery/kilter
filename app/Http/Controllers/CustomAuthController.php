<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomAuthController extends Controller
{
    
    public function resetpassword(){

        return view('auth/reset_password');
    }
    
    public function customresetpassword(Request $request){

        $requestData = $request->all();

        if($requestData['currentpassword'] == '12345678'){
             User::where('email',$requestData['email'])->update([
                'password' => Hash::make($requestData['password']),
            ]);
            return redirect()->route('login')->with('success','Password reset Successfully');
        }else{
            
            return redirect()->route('login')->with('error','Please contact admin! Current Password is invalid');
        }
        
    }
}
