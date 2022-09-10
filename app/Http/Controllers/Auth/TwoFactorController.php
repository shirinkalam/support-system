<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Code;
use App\Services\Auth\TwoFactorAuthentication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    protected $twoFactor;

    public function __construct(TwoFactorAuthentication $twoFactor)
    {
        $this->middleware('auth')->except('resent');
        $this->twoFactor = $twoFactor ;
    }

    public function showToggleForm()
    {
        return view('auth.two-factor.toggle');
    }

    public function showEnterCodeForm()
    {
        return view('auth.two-factor.enter-code');
    }

    public function activate()
    {
        $response = $this->twoFactor->requestCode(Auth::user());

        return $response == $this->twoFactor::CODE_SENT
        ? redirect()->route('auth.two.factor.code.form')
        : back()->with('cantSentCode',true);
    }

    public function confirmCode(Code $request)
    {
        #validate CODE
        $this->validateForm($request);
        $response = $this->twoFactor->activate();

        return $request == $this->twoFactor::ACTIVATED
        ? redirect()->route('home')->with('twoFactorActivated',true)
        : back()->with('invalidCode',true);
    }

    public function deactivate()
    {
        $this->twoFactor->deactivate(Auth::user());

        return back()->with('twoFactorDeactivated');
    }

    public function resent()
    {
        $this->twoFactor->resent();

        return back()->with('codeResent',true);
    }
}
