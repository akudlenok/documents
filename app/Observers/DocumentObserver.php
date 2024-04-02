<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Document;
use App\Notifications\DocumentDeletedNotification;
use App\Notifications\DocumentUpdatedNotification;
use App\Services\ChangeHistoryService;
use Illuminate\Support\Facades\Notification;

class DocumentObserver
{
    public function updated(Document $document): void
    {
        if ($document->wasChanged('content')) {
            $changeHistoryService = app(ChangeHistoryService::class);
            $changeHistoryService->create(Document::class, $document->id, 'content', $document->getOriginal('content'));
            $this->sendNotifications($document);
        }
    }

    public function deleted(Document $document): void
    {
        $this->sendNotifications($document, true);
    }

    private function sendNotifications(Document $document, $isDeleted = false): void
    {
        $template = $isDeleted ? DocumentDeletedNotification::class : DocumentUpdatedNotification::class;
        Notification::send($document->users, new $template($document));
    }
}
