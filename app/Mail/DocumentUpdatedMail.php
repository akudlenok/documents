<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Document;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly Document $document, private readonly User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Document Updated',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.documents.updated',
            with: [
                'title' => $this->document->name,
                'userName' => $this->user->full_name,
                'url' => ''
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
