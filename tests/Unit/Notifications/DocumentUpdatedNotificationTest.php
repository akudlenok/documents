<?php

namespace Tests\Unit\Notifications;

use App\Models\Document;
use App\Models\User;
use App\Notifications\DocumentUpdatedNotification;
use App\Services\ChangeHistoryService;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class DocumentUpdatedNotificationTest extends TestCase
{
    public function testUpdate(): void
    {
        Notification::fake();
        $document = Document::factory()
            ->hasAttached(
                User::factory()->count(3)
            )
            ->create();

        $this->mock(ChangeHistoryService::class)->shouldReceive('create')->once();

        $document->content = 'New content';
        $document->save();

        Notification::assertSentTo(
            $document->users,
            DocumentUpdatedNotification::class,
        );
    }
}
