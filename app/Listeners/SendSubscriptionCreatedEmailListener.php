<?php

namespace App\Listeners;

use App\Events\SubscriptionCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendSubscriptionCreatedEmailListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(SubscriptionCreatedEvent $event)
    {
        /*
         * Dispatch admin created email job
         */
        dispatch(new \App\Jobs\SendSubscriptionCreatedEmailJob($event->userDetails));
    }
}
