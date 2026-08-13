<?php

namespace Modules\GeneralScannedDocument\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralScannedDocument\Models\ScannedDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScannedDocumentTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        ScannedDocument::factory()->count(3)->create();
        $response = $this->getJson('/api/scanned_documents');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = ScannedDocument::factory()->make()->toArray();
        $response = $this->postJson('/api/scanned_documents', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('scanned_documents', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = ScannedDocument::factory()->create();
        $response = $this->getJson("/api/scanned_documents/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = ScannedDocument::factory()->create();
        $response = $this->putJson("/api/scanned_documents/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('scanned_documents', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = ScannedDocument::factory()->create();
        $response = $this->deleteJson("/api/scanned_documents/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('scanned_documents', ['id' => $model->id]);
    }
}
