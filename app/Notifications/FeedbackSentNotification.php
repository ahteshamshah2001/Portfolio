<?php

namespace App\Notifications;

use App\Mail\FeedbackSentEmail as FeedbackSentMailable;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FeedbackSentNotification extends Notification
{
    use Queueable;

    public $feedbackResponse;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($feedbackResponse)
    {
        $this->feedbackResponse = $feedbackResponse;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return FeedbackSentMailable
     */
    public function toMail($notifiable)
    {
        return (new FeedbackSentMailable([
            'response' => $this->feedbackResponse,
            'sender' => auth()->user(),
            'receiver' => $notifiable
        ]));
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
            'response' => $this->feedbackResponse,
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
                'response' => $this->feedbackResponse,
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
