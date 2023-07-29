<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Mail;

class AuthController extends Controller
{
    /*Loading Resgiter View*/
    public function login(){
        return view('website.auth.login.index', get_defined_vars());
    }

    /*Loading Resgiter View*/
    public function register(){
        return view('website.auth.register.index', get_defined_vars());
    }

    /*Register New Customer*/
    public function loginCustomer(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ],
            [
                'email.required' => 'Email can\'t be blank.',
                'password.required' => 'Password can\'t be blank.',
            ]
        );

        // return $request->except('_token');
        if(Auth::attempt($request->except('_token', 'g-recaptcha-response'))){
            return redirect()->route('website.home.index');
        }else{
            return redirect()->back()->with('message', 'Invalid Email or Password');
        }


    }

    /*Register New Customer*/
    public function registerCustomer(Request $request){
        $request->validate([
            'email' => ['required', Rule::unique('users')->where('customer_type', 0)],
            'password' => 'required|confirmed|min:8',
            'g-recaptcha-response' => 'required|captcha',
        ],
            [
                'email.required' => 'Email can\'t be blank.',
                'password.required' => 'Password can\'t be blank.',
                'password.confirmed' => 'Passwords are not matched..',
                'password.min' => 'The password must be at least 8 characters.',
            ]
        );

        $user = User::create($request->all());

        $details = [
            'link' => route('website.auth.register-emial-verification', base64_encode($request->email))
        ];

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('website.home.index');
        }

    }

    /*Register Email Verification*/
    public function registerEmailVerification($token){
        $email = base64_decode($token);
        // return $email;
        $is_verified = User::where('email', $email)->pluck('is_verified')->first();

        if($is_verified == 1){
            return 'Link Expired';
        }

        User::where('email', $email)->update(['is_verified' => 1]);

        return 'Your Account is Verified Congratulations';

    }

    /*Loading Forgot Password View*/
    public function forgotPassword(){
        return view('website.auth.forgotpassword.index', get_defined_vars());
    }

    /*Loading Forgot Password Process*/
    public function forgotPasswordProcess(Request $request){
        $request->validate([
            'email' => 'required'
        ],
            [
                'email.required' => 'The email field is required.'
            ]
        );

        $user = User::where('email', $request->email)->first();

        if(is_null($user)){
            return redirect()->back()->with('message', 'Email does not exists in our system.');
        }

        $reset_password_token = md5($user->email.$user->id);

        $user->reset_password_token = $reset_password_token;
        $user->update();

        $details = [
            'link' => route('website.auth.reset-password', $reset_password_token)
        ];

        Mail::to($request->email)->send(new \App\Mail\ResetPasswordMail(['details' => $details]));

        return redirect()->route('website.auth.login')->with('message', 'You will receive an email with a link to reset your password.');


    }

    /*Loading Reset Password View*/
    public function resetPassword($token){
        $user = User::where('reset_password_token', $token)->first();
        $hasToken = !is_null($user) ? true : false;
        return view('website.auth.resetpassword.index', get_defined_vars());
    }

    /*Loading Reset Password Process*/
    public function resetPasswordProcess(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ],
            [
                'password.required' => 'Password can\'t be blank.',
                'password.confirmed' => 'Passwords are not matched..',
                'password.min' => 'The password must be at least 8 characters.',
            ]
        );

        $user = User::where('reset_password_token', $request->token)->first();

        if(is_null($user)){
            return redirect()->route('website.auth.login');
        }

        $user->reset_password_token = '';
        $user->update();

        return redirect()->route('website.auth.login')->with('message', 'Password Reset Successfully!.');


    }

    /*Logout User*/
    public function logout(){
        Auth::logout();
        return redirect()->route('website.home.index');
    }
}
