<?php

namespace App\Mail;

use App\Enum\UserTypeEnum;
use App\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly Subscription $subscription)
    {
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->subscription->email,
            subject: "Welcome, {$this->subscription->first_name}!",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = match ($this->subscription->user_type) {
            UserTypeEnum::STUDENT => 'mails.welcome.student',
            UserTypeEnum::PARENT => 'mails.welcome.parent',
            UserTypeEnum::TEACHER => 'mails.welcome.teacher',
            UserTypeEnum::PRIVATE_TUTOR => 'mails.welcome.private-tutor',
        };

        return new Content(
            view: $view,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
