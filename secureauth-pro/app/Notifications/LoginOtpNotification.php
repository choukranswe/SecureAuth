<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginOtpNotification extends Notification
{
    use Queueable;

    public function __construct(
        public readonly string $otp,
        public readonly int $expiresInMinutes = 10,
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('SecureAuth Pro login code')
            ->greeting('Secure login verification')
            ->line('Use this one-time code to finish signing in to SecureAuth Pro:')
            ->line($this->otp)
            ->line("This code expires in {$this->expiresInMinutes} minutes.")
            ->line('If you did not try to sign in, you can ignore this message.');
    }
}
