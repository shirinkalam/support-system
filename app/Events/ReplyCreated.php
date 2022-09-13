<?php

namespace App\Events;

use App\Models\Reply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReplyCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $reply;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reply $reply , $user)
    {
        $this->reply = $reply;
        $this->user = $user;
    }
}
