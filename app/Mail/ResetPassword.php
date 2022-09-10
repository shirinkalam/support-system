<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,string $token)
    {
        $this->user= $user ;
        $this->token= $token ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset-password')->with([
            'link'=> $this->generateLink()
        ]);
    }

    public function generateLink()
    {
        return route('auth.password.reset.form',[
            'token'=>$this->token,
            'email'=>$this->user->email,
        ]);
    }
}
