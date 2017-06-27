<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roomdonate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class RoomdonateController extends Controller
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

     //input roomreq_id,status
     //check status user
    public function store(Request $request)
    {
        //check req,donate same user
        if(){

        }

        //check ready user
        if(Auth::user()->status == 'unready'){
            return "you unready";
        }

        //validate user_id duplicated
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|unique:roomdonates',
            'status' => 'required|string',
       ]);

       if ($validator->fails()) {
        //    return $validator->errors()->toArray();
            return $validator->messages();
            // return $validator->errors()->all();

       }else{

       }

        $dona = new Roomdonate;
        $dona->roomreq_id = $request->roomreq_id;
        $dona->user_id = Auth::user()->id;
        $dona->status = $request->status;
        $dona->save();

        return "add room : ".$dona->roomreq_id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  input roomreq_id
    public function show($id)
    {
        $dona = DB::table('roomdonates')->select('id','roomreq_id','user_id','status')->where('roomreq_id',$id)->get();
        return $dona;
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
