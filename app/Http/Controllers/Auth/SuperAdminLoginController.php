<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\SuperAdmin;

class SuperAdminLoginController extends Controller
{
    //

    //
      //
      public function __construct(){
        $this->middleware('guest:superadmin')->except('logout');
    }
    public function showloginForm(){
        return view('auth.superadmin-login');
    }

    public function login(Request $request){
        //validate the form data
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6'
        ]);
        //attempt to login
        if(Auth::guard('superadmin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //if successsful , then redirect
            return redirect()->intended(route('superadmin.dashboard'));
        }
        return redirect()->back()->withinput($request->only('email','remember'));


    }
    public function logout(){
        Auth::guard('superadmin')->logout();
        return redirect('/');
    }
}
