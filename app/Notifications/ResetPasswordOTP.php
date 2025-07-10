<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordOTP extends Notification
{
    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Password Reset OTP')
                    ->line('Your OTP for password reset is: ' . $this->otp)
                    ->line('This OTP will expire in 15 minutes.');
    }
}
