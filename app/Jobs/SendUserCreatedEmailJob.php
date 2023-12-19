<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

/**
 * Class SendAdminCreatedEmailJob
 *
 * @author Mujtaba Ahmed <mujtaba.ahmed@vservices.com>
 * @date   8/21/2020
 */
class SendUserCreatedEmailJob implements ShouldQueue
{
    public $data;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->data['email'];

        Mail::to($email)->send(
            new \App\Mail\UserCreatedEmail($this->data)
        );
    }
}
