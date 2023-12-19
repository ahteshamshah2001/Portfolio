<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionCreatedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userDetails;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $userDetails)
    {
        $this->userDetails = $userDetails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->userDetails['email'];

        Mail::to($email)->send(
            new \App\Mail\SubscriptionCreatedEmail($this->userDetails)
        );
    }
}
