<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function formLogin(){


        return view('backend.auth.login');
    }


    public function login(Request $request){

          if (auth()->guard('web')->attempt(['username'=>$request->input('username'),'password'=>$request->input('password')])){

              return redirect()->route('dashboard');


          }


    }

    public function logout(){

      Auth::logout();
      return redirect()->route('formLogin');
    }



}
