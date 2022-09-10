<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $user;
    private $text;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,string $text)
    {
        $this->user = $user ;
        $this->text = $text ;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notification $notification)
    {
        return $notification->sendSms($this->user,$this->text);
    }
}
