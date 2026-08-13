<?php
namespace Modules\PembatalanReturnCancellation\Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembatalanReturnCancellation\Models\ReturnCancellation;
use Modules\Auth\Models\User;
class ReturnCancellationTest extends TestCase {
    use RefreshDatabase;
    protected function setUp(): void {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }
    public function test_can_list() {
        ReturnCancellation::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/return-cancellations');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }
    public function test_can_create() {
        $response = $this->postJson('/api/v1/return-cancellations', [
            'return_id' => 'RET-1',
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('return_cancellations', ['return_id' => 'RET-1']);
    }
    public function test_can_update() {
        $rc = ReturnCancellation::factory()->create(['reason' => 'Old']);
        $response = $this->putJson("/api/v1/return-cancellations/{$rc->id}", ['reason' => 'New']);
        $response->assertStatus(200);
        $this->assertEquals('New', $rc->fresh()->reason);
    }
    public function test_can_delete() {
        $rc = ReturnCancellation::factory()->create();
        $response = $this->deleteJson("/api/v1/return-cancellations/{$rc->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('return_cancellations', ['id' => $rc->id]);
    }
}
