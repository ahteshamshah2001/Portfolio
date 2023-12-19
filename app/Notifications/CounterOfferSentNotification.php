<?php

namespace App\Notifications;

use App\Mail\CounterOfferReceivedEmail as CounterOfferReceivedMailable;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class CounterOfferSentNotification extends Notification
{
    use Queueable;

    public $counterOfferResponse;

    /**
     * Create a new notification instance.
     *
     * @param $counterOfferResponse
     */
    public function __construct($counterOfferResponse)
    {
        $this->counterOfferResponse = $counterOfferResponse;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return CounterOfferReceivedMailable
     */
    public function toMail($notifiable)
    {
        return (new CounterOfferReceivedMailable(
            [
                'response' => $this->counterOfferResponse,
                'sender' => auth()->user(),
                'receiver' => $notifiable
            ]
        ));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'response' => $this->counterOfferResponse,
            'sender' => auth()->user(),
            'receiver' => $notifiable
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $notificationResponse = customizeNotification([
            'id' => $this->id,
            'data' => [
                'response' => $this->counterOfferResponse,
                'sender' => auth()->user(),
                'receiver' => $notifiable
            ],
            'read_at' => null,
            'created_at' => Carbon::now()
        ]);
        return new BroadcastMessage(['notification' => $notificationResponse]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
