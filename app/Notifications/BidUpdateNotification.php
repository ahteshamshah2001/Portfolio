<?php

namespace App\Notifications;

use App\Mail\BidUpdateEmail as BidUpdateMailable;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class BidUpdateNotification extends Notification
{
    use Queueable;

    public $bidResponse;

    /**
     * Create a new notification instance.
     *
     * @param $bidResponse
     */
    public function __construct($bidResponse)
    {
        $this->bidResponse = $bidResponse;
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
     * @return BidUpdateMailable
     */
    public function toMail($notifiable)
    {
        return (new BidUpdateMailable(
            [
                'response' => $this->bidResponse,
                'sender' => auth()->user(),
                'receiver' => $notifiable
            ]
        )
        );
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
            'response' => $this->bidResponse,
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
                'response' => $this->bidResponse,
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
