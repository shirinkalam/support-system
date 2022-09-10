<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify','send');
    }

    public function send()
    {

        if(Auth::user()->hasVerifiedEmail()){
            return redirect()->route('home');
        }

        #get user
        #create signed route
        #send url
        Auth::user()->sendEmailVerificationNotification();
        #redirect

        return back()->with('verifationEmailSent',true);
    }

    public function verify(Request $request)
    {

        if($request->user()->email !== $request->query('email')){
            throw new AuthorizationException;
        }

        #check email status
        if($request->user()->hasVerifiedEmail()){
            return redirect()->route('home');
        }
        #verify
        $request->user()->markEmailAsVerified();

        session()->forget('mustVerifyEmail');

        #redirect

        return redirect()->route('home')->with('emailHasVerified',true);
    }
}
