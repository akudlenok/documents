<?php

namespace Observers;

use App\Mail\DocumentUpdatedMail;
use App\Models\Document;
use App\Models\User;
use App\Observers\DocumentObserver;
use App\Services\ChangeHistoryService;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class DocumentObserverTest extends TestCase
{
    public function testUpdated()
    {
        $user = User::factory()->create();
        auth()->login($user);

        $document = Document::factory()
            ->hasAttached(
                User::factory()->count(3)
            )
            ->create();

        $this->mock(DocumentObserver::class)
            ->shouldReceive('updated')
            ->once();

        $document->content = 'New content';
        $document->save();
    }

    public function testDeleted()
    {
        $user = User::factory()->create();
        auth()->login($user);

        $document = Document::factory()
            ->hasAttached(
                User::factory()->count(3)
            )
            ->create();

        $this->mock(DocumentObserver::class)
            ->shouldReceive('deleted')
            ->once();

        $document->delete();
    }
}
