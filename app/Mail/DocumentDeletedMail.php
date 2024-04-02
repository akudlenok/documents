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

class DocumentDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private readonly Document $document, private readonly User $user) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Document Deleted',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.documents.deleted',
            with: [
                'title' => $this->document->name,
                'userName' => $this->user->full_name
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
