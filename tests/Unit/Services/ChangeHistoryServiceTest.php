<?php

namespace Services;

use App\Models\ChangeHistory;
use App\Models\Document;
use App\Models\User;
use App\Services\ChangeHistoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeHistoryServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        $user = User::factory()->create();
        $authUser = User::factory()->create();

        $document = Document::factory()->create();
        $service = app(ChangeHistoryService::class);
        $service->create(Document::class, $document->id, 'content', 'New content', $user->id);
        $this->assertDatabaseCount(ChangeHistory::class, 1);

        auth()->login($authUser);
        $service->create(Document::class, $document->id, 'content', 'New content by auth user');
        $this->assertDatabaseCount(ChangeHistory::class, 2);
    }
}
