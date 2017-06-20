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
                //   if($request){
        $check = $request->only(['name', 'password']);
        if(Auth::attempt($check)){
            $username = strtolower($request->name);
            $user = User::where('name', '=', $username)->first();
            Auth::login($user);

            //มีไม่มีก็ได้แสดงค่าออกมาดูเฉยๆ
            return Auth::user();
        }else{
            return "login fail";
        }

                // if(Auth::attempt($check)){
                                            // $user = Auth::user()->id;
                                            // Auth::login($check);
                //   return Auth::user();
                                            //   $user = DB::table('members')->where(['name', $request->name],['password',$request->password]);
                                            //   return $user;
                // }else{
                //   return "login fail";
                // }
                                              // if($request->name == 'ggg' && $request->password == '123456'){
                                              //     return "login suc";
                                              // }else {
                                              //     return "login fail";
                                              // }
        //   }
      }

      public function logout(){
        Auth::logout();
      }
}
