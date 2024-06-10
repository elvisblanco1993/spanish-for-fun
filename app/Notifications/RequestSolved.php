<?php

namespace App\Notifications;

use App\Models\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestSolved extends Notification
{
    use Queueable;

    public $title;

    /**
     * Create a new notification instance.
     */
    public function __construct(Request $request)
    {
        $this->title = $request->title;
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your request, '.$this->title.', has been answered.')
            ->markdown('mail.request.solved', [
                'title' => $this->title
            ]);
    }
}
