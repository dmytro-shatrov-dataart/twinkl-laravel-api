<?php

namespace App\Notifications;

use App\Mail\WelcomeEmail;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Subscription $notifiable): WelcomeEmail
    {
        return (new WelcomeEmail($notifiable));
    }
}
