<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
/**
 * Class GenerateAdminPasswordListener
 *
 * @author Mujtaba Ahmed <mujtaba.ahmed@vservices.com>
 * @date   8/21/2020
 */
class GenerateUserPasswordListener
{
    private $userRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\App\Repositories\Interfaces\UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserCreatedEvent  $event
     * @return void
     */
    public function handle(\App\Events\UserCreatedEvent $event)
    {
        $user              = $event->user;
        $rawRandomPassword = Str::random(8);
        $encryptedPassword = bcrypt($rawRandomPassword);

        $this->userRepository->update($user->id, ['password' => $encryptedPassword]);

        $data = [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => $rawRandomPassword,
        ];

        /*
         * Trigger UserPasswordCreatedEvent
         */
        event(new \App\Events\UserPasswordCreatedEvent($data));
    }
}
