<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingConfirmedNotification extends Notification
{
    use Queueable;

    public $message;
    public $link;

    public function __construct($message, $link = '#')
    {
        $this->message = $message;
        $this->link = $link;
    }

    public function via($notifiable)
    {
        return ['database']; // Store in DB
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'link' => $this->link,
        ];
    }
}
