<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()){
            $id = Auth::user()->id;
            if(count(DB::select('SELECT friends.user_id,friends.friend_id,users.name,users.phone,users.countdonate FROM `friends`,`users` WHERE (users.id = friends.friend_id) && (user_id = :id) && ( friends.friend_id = :friend_id)', ['id' => $id,'friend_id' => $request->friend_id]))>0){
                return "You've already added this account";
            }

            $friend = new Friend;
            $friend->user_id = Auth::user()->id;
            $friend->friend_id = $request->friend_id;
            $friend->save();

            return "Add Friend Success";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(Auth::user()){
            $id = Auth::user()->id;
            $user = User::where('name', '=', $id);
            // $users = DB::select('select * from users where active = ?', [1]);
            // $results = DB::select('select * from friends where user_id = :id', ['id' => $id]);
            $results = DB::select('SELECT friends.user_id,friends.friend_id,users.name,users.phone,users.countdonate FROM `friends`,`users` WHERE (users.id = friends.friend_id) && (user_id = :id)', ['id' => $id]);
            return $results;
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
