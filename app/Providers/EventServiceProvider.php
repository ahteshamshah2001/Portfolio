<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\AdminCreatedEvent' => [
            'App\Listeners\GenerateAdminPasswordListener',
        ],
        'App\Events\AdminPasswordCreatedEvent' => [
            'App\Listeners\SendAdminCreatedEmailListener',
        ],
        'App\Events\UserCreatedEvent' => [
            'App\Listeners\GenerateUserPasswordListener',
        ],
         'App\Events\UserPasswordCreatedEvent' => [
            'App\Listeners\SendUserCreatedEmailListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
