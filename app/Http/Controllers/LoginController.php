<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
// use App\Member;
// use Hash;
// use Illuminate\Auth\Reminders\RemindableInterface;
// use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //เช็คว่ามีการ login อยู่รึเปล่า
        if(Auth::user()){
          return "Please Logout !!!";
        }

        //เช็ค login 
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password])){
            $username = strtolower($request->name);
            $user = User::where('name', '=', $username)->first();
            Auth::login($user);

            //มีไม่มีก็ได้แสดงค่าออกมาดูเฉยๆ
            return Auth::user();
        }elseif (Auth::attempt(['phone'=> $request->name, 'password' => $request->password])) {
            $phone = strtolower($request->name);
            $user = User::where('phone', '=', $phone)->first();
            Auth::login($user);
            return Auth::user();
        }else{
            return "login fail";
        }
    }

    public function logout(){
        Auth::logout();
    }
}
