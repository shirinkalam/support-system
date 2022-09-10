<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // use RegistersUsers;

    protected $redirectTo ='/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function create(array $data)
    {
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'phone_number'=>$data['phone_number'],
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        #validate
        $this->validateForm($request);

        #store user
        $user = $this->create($request->all());
        #login
        Auth::login($user);

        #send email verification
        event(new UserRegistered($user));

        #redirect
        return redirect()->route('home')->with('registered',true);
    }

    protected function validateForm(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','string','email','max:255','unique:users'],
            'password'=>['required','string','min:8','confirmed'],
            'phone_number'=>['required','numeric','digits:11','nullable'],
        ]);
    }

}
