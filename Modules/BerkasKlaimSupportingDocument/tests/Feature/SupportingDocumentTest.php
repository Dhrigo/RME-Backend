<?php

namespace Modules\BerkasKlaimSupportingDocument\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BerkasKlaimSupportingDocument\Models\SupportingDocument;
use Modules\BerkasKlaimClaimFile\Models\ClaimFile;
use Modules\Auth\Models\User;

class SupportingDocumentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_can_list_supporting_documents()
    {
        SupportingDocument::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/supporting-documents');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_supporting_document()
    {
        $file = ClaimFile::factory()->create();

        $response = $this->postJson('/api/v1/supporting-documents', [
            'claim_file_id' => $file->id,
            'document_type' => 'Invoice',
            'file_path' => '/path/to/invoice.pdf'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('supporting_documents', ['claim_file_id' => $file->id]);
    }

    public function test_can_update_supporting_document()
    {
        $doc = SupportingDocument::factory()->create(['document_type' => 'Old']);

        $response = $this->putJson("/api/v1/supporting-documents/{$doc->id}", [
            'document_type' => 'New'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('New', $doc->fresh()->document_type);
    }

    public function test_can_delete_supporting_document()
    {
        $doc = SupportingDocument::factory()->create();

        $response = $this->deleteJson("/api/v1/supporting-documents/{$doc->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('supporting_documents', ['id' => $doc->id]);
    }
}
