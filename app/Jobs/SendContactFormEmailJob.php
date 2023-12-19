<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class SendPrincipalSignupEmailJob
 *
 * @author Muhammad Shahab <muhammad.shahab@vservices.com>
 * @date 7/17/19
 */
class SendContactFormEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The request instance.
     *
     * @var Request
     */
    public $contactFormData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contactFormData)
    {
        $this->contactFormData = $contactFormData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $siteSettings = \App\Models\SiteSetting::first();

        if (isset($siteSettings)) {
            Mail::to($siteSettings->contact_email)->send(
                new \App\Mail\ContactFormEmail($this->contactFormData)
            );
        }
    }
}
