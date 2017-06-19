<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class LoginController extends Controller
{
    public function logintest(){
        $check = Input::only('name','password');
        if(Auth::attempt($check)){
          return $check;
        }else{
          echo "login fail";
        }
    }

    public function login(Request $request)
      {
          if($request){
            $check = $request->only(['name', 'password']);
            if(Auth::attempt($check)){
              return $check;
            }else{
              echo "login fail";
            }
              // if($request->name == 'ggg' && $request->password == '123456'){
              //     return "login suc";
              // }else {
              //     return "login fail";
              // }
          }
      }
}
