<?php

namespace App\Listeners;

use App\Events\ContactFormEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class SendContactFormEmailListener
 *
 * @author Muhammad Shahab <muhammad.shahab@vservices.com>
 * @date   7/17/19
 */
class SendContactFormEmailListener
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
     * @param  ContactFormEvent  $event
     * @return void
     */
    public function handle(ContactFormEvent $event)
    {
        /*
         * Dispatch contact form email job
         */
        dispatch(new \App\Jobs\SendContactFormEmailJob($event->contactFormData));
    }
}
