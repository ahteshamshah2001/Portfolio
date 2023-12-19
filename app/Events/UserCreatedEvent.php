<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * Class UserCreatedEvent
 *
 * @author Mujtaba Ahmed <mujtaba.ahmed@vservices.com>
 * @date   8/21/2020
 */
class UserCreatedEvent
{
    public $user;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Interfaces\UserInterface $user)
    {
        $this->user = $user;
    }
}
