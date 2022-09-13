<?php

namespace App\Listeners;

use App\Events\ReplyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangeTicketStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ReplyCreated  $event
     * @return void
     */
    public function handle(ReplyCreated $event)
    {
        if($event->reply->ticket->isCreated() && $event->user->isAdmin()){
            $event->reply->ticket->replied();
        }

    }
}
