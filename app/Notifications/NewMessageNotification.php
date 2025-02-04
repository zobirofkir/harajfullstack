<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail']; // Send via email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('You have a new message!')
            ->line('You have received a new message from '.$this->message->username)
            ->line('Message: '.$this->message->content)
            ->line('Thank you for using our application!');
    }
}
