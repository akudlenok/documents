<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Mail\DocumentUpdatedMail;
use App\Models\Document;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class DocumentUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Document $document)
    {
    }

    public function via(User $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): Mailable
    {
        return (new DocumentUpdatedMail($this->document, $notifiable))->to($notifiable);
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
