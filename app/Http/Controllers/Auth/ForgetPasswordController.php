<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
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

    public function sendResetLink(Request $request)
    {
        #Validate
        $this->validateForm($request);
        #create link
        #send link
        $response = Password::broker()->sendResetLink($request->only('email'));

        if($response === Password::RESET_LINK_SENT){
            return back()->with('resetLinkSent',true);
        }

        #redirect
        return back()->with('resetLinkFailed',true);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'email'=>['required','string','email','exists:users'],
        ]);
    }

}
