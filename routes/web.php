<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('test','TestController');

Route::get('token',function(){
    return csrf_token();
});

Route::post('login','LoginController@login');
Route::post('register','MemberController@store');
Route::get('logout','LoginController@logout');

Route::resource('friend', 'FriendController');
