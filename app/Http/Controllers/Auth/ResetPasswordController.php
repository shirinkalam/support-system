<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    protected $redirectTo ='/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showForgetForm()
    {
        return view('auth.forget-password');
    }

    public function reset(Request $request)
    {
        #Validate
        $this->validateForm($request);
        #check token and email
        $response = Password::broker()->reset(
            $request->only('email','password','password_confirmation ','token'),
            function($user,$password){
                #change password
                $this->resetPassword($user,$password);
            }
        );
        #redirect
        return $response ===Password::PASSWORD_RESET ?
            redirect()->route('auth.login')->with('passwordChanged',true)
            : back()->with('cantChangePassword',true);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'password'=>['required','string','min:8','confirmed'],
            'email'=>['required','string','email','exists:users'],
            'token'=>['required','string'],
        ]);
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset-password',[
            'email' => $request->query('email'),
            'token' => $request->query('token'),
        ]);
    }

    public function resetPassword($user , $password)
    {
        #change password
        $user->password = Hash::make($password);
        $user->save();
    }
}
