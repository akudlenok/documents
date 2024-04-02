<?php

declare(strict_types=1);

namespace Api;

use App\Models\Document;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdate(): void
    {
        $document = Document::factory()->create();

        $this->put('api/documents/' . $document->id)
            ->assertUnprocessable()
            ->assertInvalid(['name' => 'required'])
            ->assertInvalid(['content' => 'required']);

        $this->put('api/documents/' . $document->id + 1, ['name' => 'Test name', 'content' => 'Test content'])
            ->assertNotFound();

        $this->put('api/documents/' . $document->id, ['name' => 'Test name', 'content' => 'Test content'])
            ->assertOk()
            ->assertJson([
                    'data' => [
                        'name' => 'Test name',
                        'content' => 'Test content',
                    ]
                ]
            );
    }

    public function testDelete(): void
    {
        $document = Document::factory()->create();
        $response = $this->delete('api/documents/' . $document->id);
        $response->assertStatus(204);

        $response = $this->delete('api/documents/' . $document->id);
        $response->assertStatus(404);
    }
}
