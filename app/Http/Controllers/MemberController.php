<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

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
        if(Auth::user()){
            return "Logout please 1";
        }

        // $this->validate($request, [
        //     'name' => 'required|string|max:255|Alpha',
        //     'blood' => 'required|string|max:2',
        //     'phone' => 'required|string|max:255',
        // ]);//alpha คือตัวหนังสือ


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191|Alpha|unique:users',
            'blood' => 'required|string|max:2',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'blood' => 'required|string|max:2',
            'blood_type' => 'required|string|max:8',
            'birthyear' => 'required|integer|max:3000',
            'phone' => 'required|string|max:10|unique:users',
            'province' => 'required|string|max:255',
            'password_confirmation' => 'required|string|min:6',
            'real_name' => 'required|string|Alpha',
            'real_surname' => 'required|string|Alpha',
       ]);

       if ($validator->fails()) {
        //    return $validator->errors()->toArray();
            return $validator->messages();
            // return $validator->errors()->all();

       }else{

       }

        $member = new User;
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->blood = $request->blood;
        $member->blood_type = $request->blood_type;
        $member->birthyear = $request->birthyear;
        $member->phone = $request->phone;
        $member->province = $request->province;
        $member->last_date_donate = $request->last_date_donate;
        $member->real_name = $request->real_name;
        $member->real_surname = $request->real_surname;
        $member->save();

        Auth::login($member);

        return "Register Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response     */
    public function show()
    {
        if(Auth::user()){
            $user = DB::table('users')->select('img','name', 'email','phone','blood','blood_type','status')->where('id', Auth::user()->id)->get();

            // return Response::json($user);
            return $user;
        }else{
            return "Login pls 3";
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

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(Auth::user()){
            // validate
            // read more on validation at http://laravel.com/docs/validation
            $rules = array(
                'phone' => 'string|max:255',
                'email' => 'string|email|max:191',
                'blood' => 'string|max:2',
                'birthyear' => 'integer|max:3000',
                'blood_type' => 'string|max:8',
            );
            $validator = Validator::make($request->all(), $rules);

            // process the login
            if ($validator->fails()) {
                return $validator->errors()->toArray();
            }else {
                // store
                $update = User::find(Auth::user()->id);
                $update->email = $request->email;
                $update->blood = $request->blood;
                $update->blood_type = $request->blood_type;
                $update->phone = $request->phone;
                $update->save();

                return "Update Success";
            }
        }else{
            return "Login plz 2";
        }
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

    public function showDonate(){
      $dona = DB::table('roomdonates')->select('id','roomreq_id','user_id','status')->where('user_id',Auth::user()->id)->get();
          return $dona;
    }
}
