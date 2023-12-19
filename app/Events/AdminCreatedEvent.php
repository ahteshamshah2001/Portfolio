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
 * Class AdminCreatedEvent
 *
 * @author Muhammad Shahab Khan <muhammad.shahab@vservices.com>
 * @date   7/17/2019
 */
class AdminCreatedEvent
{
    public $admin;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Admin $admin)
    {
        $this->admin = $admin;
    }
}
