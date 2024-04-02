<?php

namespace Services;

use App\Models\Document;
use App\Services\DocumentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testEdit()
    {
        $service = app(DocumentService::class);
        $document = Document::factory()->create();
        $result = $service->update($document, ['name' => 'New title']);
        $this->assertEquals($result->name, 'New title');
    }

    public function testDelete()
    {
        $service = app(DocumentService::class);
        $document = Document::factory()->create();
        $result = $service->delete($document);
        $this->assertTrue($result);
        $this->assertModelMissing($document);
    }
}
