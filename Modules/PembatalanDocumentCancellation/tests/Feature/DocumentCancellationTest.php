<?php
namespace Modules\PembatalanDocumentCancellation\Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembatalanDocumentCancellation\Models\DocumentCancellation;
use Modules\Auth\Models\User;
class DocumentCancellationTest extends TestCase {
    use RefreshDatabase;
    protected function setUp(): void {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }
    public function test_can_list() {
        DocumentCancellation::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/document-cancellations');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }
    public function test_can_create() {
        $response = $this->postJson('/api/v1/document-cancellations', [
            'document_id' => 'DOC-1',
            'document_type' => 'Invoice',
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('document_cancellations', ['document_id' => 'DOC-1']);
    }
    public function test_can_update() {
        $dc = DocumentCancellation::factory()->create(['reason' => 'Old']);
        $response = $this->putJson("/api/v1/document-cancellations/{$dc->id}", ['reason' => 'New']);
        $response->assertStatus(200);
        $this->assertEquals('New', $dc->fresh()->reason);
    }
    public function test_can_delete() {
        $dc = DocumentCancellation::factory()->create();
        $response = $this->deleteJson("/api/v1/document-cancellations/{$dc->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('document_cancellations', ['id' => $dc->id]);
    }
}
