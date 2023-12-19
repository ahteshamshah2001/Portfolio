<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendUserCreatedEmailListener
 *
 * @author Mujtaba Ahmed <mujtaba.ahmed@vservices.com>
 * @date   8/21/2020
 */
class SendUserCreatedEmailListener
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
     * @param  \App\Events\UserPasswordCreatedEvent  $event
     * @return void
     */
    public function handle(\App\Events\UserPasswordCreatedEvent $event)
    {
        /*
         * Dispatch admin created email job
         */
        dispatch(new \App\Jobs\SendUserCreatedEmailJob($event->data));
    }
}
