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


Route::get('logout','LoginController@logout');
Route::post('login','LoginController@login');

Route::get('profile','MemberController@show');
Route::get('showdonate','MemberController@showDonate');
Route::post('checkregis','MemberController@checkregis');
Route::post('register','MemberController@store');
Route::put('edit','MemberController@update');

Route::get('showreqall','RoomreqController@showreqall');
Route::post('detailreq','RoomreqController@show');
Route::post('refresh','RoomreqController@refresh');
Route::post('status_suc','RoomreqController@status_suc');
Route::put('thankyou','RoomreqController@thankyou');

Route::resource('donate','RoomdonateController');
Route::resource('friend', 'FriendController');
Route::resource('request','RoomreqController');

/////////////////////////////////////////
Route::get('tete',function(){
  return view('login/form');
});

Route::post('/getmsg','TestController@ajax');
Route::get('testajax1',function(){
  return view('testAjax');
});
