<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\Return_;

class SocialController extends Controller
{
    public function redirectToProvider($driver)
    {
       return Socialite::driver($driver)->redirect();
    }

    public function providerCallback($driver)
    {
       $user = Socialite::driver($driver)->user();

       Auth::login($this->findeOrCreateUser($user,$driver));

       return redirect()->intended();

    }

    public function findeOrCreateUser($user,$driver)
    {
        $providerUser = User::where([
            'email' =>$user->getEmail(),
        ])->first();

        if(!is_null($providerUser)) return $providerUser ;

        return User::create([
            'email'=>$user->getEmail(),
            'name' =>$user->getName(),
            'provider' =>$driver,
            'provider_id' =>$user->getId(),
            'avatar' =>$user->getAvatar(),
            'email_verified_at' =>now(),
        ]);
    }
}
