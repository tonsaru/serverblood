<?php

namespace App\Http\Controllers;

use App\Roomreq;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoomreqController extends Controller
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
            $req = new Roomreq;
            $req->user_id = Auth::user()->id;
            $req->patient_id = $request->patient_id;
            $req->patient_name = $request->patient_name;
            $req->patient_blood = $request->patient_blood;
            $req->patient_blood_type = $request->patient_blood_type;
            $req->patient_detail = $request->patient_detail;
            $req->patient_province = $request->patient_province;
            $req->countblood = $request->countblood;
            $req->patient_hos = $request->patient_hos;
            $req->patient_hos_la = $request->patient_la;
            $req->patient_hos_long = $request->patient_long;

            $req->save();
        }else{
            return "Login Please !!";
        }


        return "Request Success";
    }

    //input roomreq_id
    public function refresh(Request $request){

        //เช็คว่า roomreq_id ที่เข้าเป็นของเรารึเปล่า
        $update = Roomreq::find($request->roomreq_id);
        if($update->user_id != Auth::user()->id){
            return "not enter";
        }

        $update->count_refresh =$update->count_refresh+1;
        $update->save();

        return "Refresh Succesful  <br />UserID: ".$update->user_id."<br />RoomID : ".$update->id."<br />CountRefresh = ".$update->count_refresh;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  input roomreqID
    public function show(Request $request)
    {
        //check ว่าเข้าได้เฉพาะของที่ตัวเองมี
        $req = DB::table('roomreqs')->where([
                ['id',$request->roomreq_id],
                ['user_id',Auth::user()->id]
            ])->get();

        if($req->count() == 0){
            return 'no data';
        }

        return $req;
    }

    //แสดง req ทั้งหมดของ user ที่ login
    public function showreqall(){
        $req = DB::table('roomreqs')->select('user_id','id','created_at','patient_name','patient_hos','patient_blood','patient_blood_type','patient_status')->where('user_id',Auth::user()->id)->get();

        return $req;
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

    // input roomreqID
    public function thankyou(Request $request){
        $update = Roomreq::find($request->roomreq_id);
        if($update->user_id == Auth::user()->id){
            if($update->patient_status == 'complete'){
                $update->patient_thankyou = $request->thankyou;
                $update->save();

                return "Thank you for thanks";
            }else{
                return "Status is not complete";
            }
        }else{
            return "not enter";
        }
    }

    public function status_suc(Request $request){
        $update = Roomreq::find($request->roomreq_id);
        if($update->user_id == Auth::user()->id){
            if($update->patient_status == 'complete'){
                return "Status complete already";
            }else{
                $update->patient_status = 'complete';
                $update->save();
                return "Status RoomreqID : ".$update->id." is ".$update->patient_status;
            }



        }else{
            return "Roomreq is not you ID";
        }
    }
}
