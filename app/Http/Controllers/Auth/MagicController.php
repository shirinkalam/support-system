<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginToken;
use App\Services\Auth\MagicAuthentication;
use Illuminate\Http\Request;

class MagicController extends Controller
{
    protected $auth;

    public function __construct(MagicAuthentication $auth)
    {
        $this->middleware('guest');
        $this->auth = $auth;
    }

    public function showMagicForm()
    {
        return view('auth.magic-login');
    }

    public function sendToken(Request $request )
    {
        #validate
        $this->validateForm($request);
        #generate token
        #send token
        $this->auth->requestLink();
        #redirect
        return back()->with('magicLinkSent',true);

    }

    public function login(LoginToken $token)
    {
        $this->auth->authenticate($token) == $this->auth::AUTHENTICATED
        ? redirect()->route('home')
        : redirect()->route('auth.magic.login.form')->with('invalidToken',true);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'email'=>['required','string','email','exists:users'],
        ]);
    }
}
