<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Code;
use App\Models\User;
use App\Services\Auth\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    protected $redirectTo ='/home';

    protected $twoFactor;

    public function __construct(TwoFactorAuthentication $twoFactor)
    {
        $this->middleware('guest')->except('logout');
        $this->twoFactor = $twoFactor ;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showCodeForm()
    {
        return view('auth.two-factor.login-code');
    }

    public function login(Request $request)
    {

        #validate
        $this->validateForm($request);

        #check user and password
        if(!$this->isValidCredentials($request)){
            return $this->sendLoginFaildResponse();
        }

        $user = $this->getUser($request);

        if($user->hasTwoFactor()){
            $this->twoFactor->requestCode($user);
            return $this->sendHasTwoFactorResponse();
        }
        #login
        Auth::login($user,$request->remember);
        #redirect
        return $this->sendSuccessResponse();
    }

    public function confirmCode(Code $request)
    {
        $response = $this->twoFactor->login();
        return $response == $this->twoFactor::AUTHENTICATED
        ? $this->sendSuccessResponse()
        : back()->with('invalidCode',true);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'email'=>['required','string','email','exists:users'],
            'password'=>['required','min:8'],
        ]);
    }

    protected function sendHasTwoFactorResponse()
    {
        return redirect()->route('auth.login.code.form');
    }

    protected function isValidCredentials($request)
    {
        return Auth::validate($request->only(['email','password']));
    }


    protected function sendSuccessResponse()
    {
        session()->regenerate();
        return redirect()->intended();
    }

    protected function sendLoginFaildResponse()
    {
        return back()->with('wronCredentials',true);
    }

    protected function getUser($request)
    {
        return User::where('email',$request->email)->firstOrFail();
    }

    public function logout()
    {
        session()->invalidate();

        Auth::logout();

        return redirect()->route('home');
    }
}
