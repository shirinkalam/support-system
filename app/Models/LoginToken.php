<?php

namespace App\Models;

use App\Jobs\SendEmail;
use App\Mail\SendMagicLink;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model
{
    const TOKEN_EXPIRY = 120;

    protected $fillable = [
        'token',
    ];

    public function getRouteKeyName()
    {
        return 'token';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function send(array $options)
    {
        SendEmail::dispatch($this->user,new SendMagicLink($this,$options));
    }

    public function isExpired()
    {
        return $this->created_at->diffInSeconds(now()) > self::TOKEN_EXPIRY;
    }

    public function scopeExpired($query)
    {
        return $query->where('created_at','<',now()->subSecond(self::TOKEN_EXPIRY))->delete();
    }
}
