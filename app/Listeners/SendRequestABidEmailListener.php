<?php

namespace App\Listeners;

use App\Events\RequestABidEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRequestABidEmailListener
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
    public function handle(RequestABidEvent $event)
    {
        /*
         * Dispatch request a bid email job
         */
        dispatch(new \App\Jobs\SendRequestABidEmailJob($event->data));
    }
}
