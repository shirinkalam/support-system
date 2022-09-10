<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Jobs\SendEmail;
use App\Mail\ResetPassword;
use App\Mail\VerificationEmail;
use App\Services\Auth\Traits\HasTwoFactor;
use App\Services\Auth\Traits\MagicallyAthenticable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,MagicallyAthenticable,HasTwoFactor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'provider',
        'provider_id',
        'email_verified_at',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        SendEmail::dispatch($this,new VerificationEmail($this));
    }

    public function sendPasswordResetNotification($token)
    {
        SendEmail::dispatch($this,new ResetPassword($this,$token));
    }
}
