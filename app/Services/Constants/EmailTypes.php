<?php

namespace App\Services\Constants;
use App\Mail\UserRegistered;
use App\Mail\TopicCreated;
use App\Mail\ForgetPassword;

class EmailTypes
{
    const USER_REGISTERED = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;

    public static function toString()
    {
        return [
            self::USER_REGISTERED =>'ثبت نام کاربر',
            self::TOPIC_CREATED =>'ایجلد مقاله جدید',
            self::FORGET_PASSWORD =>'فراموشی رمز عبور'
        ];
    }

    public static function toMail($type)
    {
        try{
            return [
                self::USER_REGISTERED =>UserRegistered::class,
                self::TOPIC_CREATED =>TopicCreated::class,
                self::FORGET_PASSWORD =>ForgetPassword::class,
            ][$type];
        }catch(\Throwable $th){
            throw new \InvalidArgumentException("Mailable Class Does Not Exist");
        }
    }

}
