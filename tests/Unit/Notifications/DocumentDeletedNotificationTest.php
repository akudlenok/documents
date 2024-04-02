<?php

namespace Notifications;

use App\Models\Document;
use App\Models\User;
use App\Notifications\DocumentDeletedNotification;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class DocumentDeletedNotificationTest extends TestCase
{
    public function testDeleted(): void
    {
        Notification::fake();
        $document = Document::factory()
            ->hasAttached(
                User::factory()->count(3)
            )
            ->create();
        $users = $document->users;
        $document->delete();
        Notification::assertSentTo(
            $users,
            DocumentDeletedNotification::class,
        );
    }
}
