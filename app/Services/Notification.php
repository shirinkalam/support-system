<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use GuzzleHttp\Client;
use App\Services\Providers\EmailProvider;
use App\Services\Providers\SmsProvider;
use App\Services\Providers\Contracts\Provider;

/**
 * @method sendSms(\App\User $user , string $text)
 * @method sendEmail(\App\User $user , Illuminate\Mail\Mailable $mailable)
 */


class Notification
{
    public function __call($method , $arguments)
    {
        $providerPath = __NAMESPACE__ . '\Providers\\' . substr($method , 4) . 'Provider';

        if(!class_exists($providerPath)){
            throw new \Exception("Class Does Not Exist");
        }

        $providerInstance = new $providerPath(...$arguments);

        if(!is_subclass_of($providerInstance,Provider::class)){
            throw new \Exception("Class Most Implements App\Services\Notification\Providers\Contracts\Provider");
        }

        return $providerInstance->send();
    }

}
