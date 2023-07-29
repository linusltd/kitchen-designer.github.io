<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*Loading Auth Index View*/
    public function index(){
        return view('admin.auth.index');
    }

    /*Login*/
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        /*Making Auth Attempt*/
        if(Auth::guard('admin')->attempt($request->except('_token'))){
            return redirect()->route('admin.dashboard.index');
        }else{
            return redirect()->back()->with('message', 'Invalid Email or Password');
        }

    }

    /*Logout*/
    public function logout(){
        Auth::logout();
        return redirect()->route('admin.auth.index');
    }
}
