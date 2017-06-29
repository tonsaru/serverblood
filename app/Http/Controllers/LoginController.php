<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Redirect;
// use App\Member;
// use Hash;
// use Illuminate\Auth\Reminders\RemindableInterface;
// use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //เช็คว่ามีการ login อยู่รึเปล่า
        if(Auth::check()){
            return "login already";
        }

        //เช็ค login
        if (Auth::attempt(['name' => strtolower($request->name), 'password' => $request->password])){
            return Auth::user();
        }elseif (Auth::attempt(['phone'=> $request->name, 'password' => $request->password])) {
            return Auth::user();
        }else{
            return "login fail";
        }
    }
        // manual Login
        // $username = strtolower($request->name);
        // $user = User::where('name', '=', $username)->first();
        // Auth::login($user);
        // Auth::loginUsingId($user->id,false);


    public function logout(){
        Auth::logout();
    }
}
