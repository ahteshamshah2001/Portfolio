<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendAdminCreatedEmailListener
 *
 * @author Muhammad Shahab <muhammad.shahab@vservices.com>
 * @date   7/17/19
 */
class SendAdminCreatedEmailListener
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
     * @param  \App\Events\AdminPasswordCreatedEvent  $event
     * @return void
     */
    public function handle(\App\Events\AdminPasswordCreatedEvent $event)
    {
        /*
         * Dispatch admin created email job
         */
        dispatch(new \App\Jobs\SendAdminCreatedEmailJob($event->data));
    }
}
