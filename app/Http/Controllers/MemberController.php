<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $member = Member::all();
        // $data = array(
        //     'member' => $member
        // );
        // return view('login/login',$data);

        return view('login/login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|Alpha',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'blood' => 'required|string|max:2',
            'birthyear' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'countdonate' => 'required|integer|max:255',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|Alpha',
            'blood' => 'required|string|max:2',
            'phone' => 'required|string|max:255',
        ]);//alpha คือตัวหนังสือ

        $member = new User;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->blood = $request->blood;
        $member->blood_type = $request->blood_type;
        $member->birthyear = $request->birthyear;
        $member->phone = $request->phone;
        $member->province = $request->province;
        $member->countdonate = $request->countdonate;
        $member->last_date_donate = $request->last_date_donate;
        $member->save();

        return "Register Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
