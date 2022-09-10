<?php
namespace App\Services\Auth\Traits;

use App\Models\LoginToken;
use Illuminate\Support\Str;

trait MagicallyAthenticable
{
    public function magicToken()
    {
        return $this->hasOne(LoginToken::class);
    }

    public function createTokenn()
    {
        $this->magicToken()->delete();

        return $this->magicToken()->create([
            'token' => Str::random(50),
        ]);
    }
}
