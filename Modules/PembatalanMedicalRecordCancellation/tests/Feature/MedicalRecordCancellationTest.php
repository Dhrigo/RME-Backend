<?php
namespace Modules\PembatalanMedicalRecordCancellation\Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembatalanMedicalRecordCancellation\Models\MedicalRecordCancellation;
use Modules\Auth\Models\User;
class MedicalRecordCancellationTest extends TestCase {
    use RefreshDatabase;
    protected function setUp(): void {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }
    public function test_can_list() {
        MedicalRecordCancellation::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/medical-record-cancellations');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }
    public function test_can_create() {
        $response = $this->postJson('/api/v1/medical-record-cancellations', [
            'medical_record_id' => 'MR-1',
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('medical_record_cancellations', ['medical_record_id' => 'MR-1']);
    }
    public function test_can_update() {
        $mc = MedicalRecordCancellation::factory()->create(['reason' => 'Old']);
        $response = $this->putJson("/api/v1/medical-record-cancellations/{$mc->id}", ['reason' => 'New']);
        $response->assertStatus(200);
        $this->assertEquals('New', $mc->fresh()->reason);
    }
    public function test_can_delete() {
        $mc = MedicalRecordCancellation::factory()->create();
        $response = $this->deleteJson("/api/v1/medical-record-cancellations/{$mc->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('medical_record_cancellations', ['id' => $mc->id]);
    }
}
