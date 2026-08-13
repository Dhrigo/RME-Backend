<?php
namespace Modules\PembatalanFinalResult\Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembatalanFinalResult\Models\FinalResult;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\Auth\Models\User;
class FinalResultTest extends TestCase {
    use RefreshDatabase;
    protected function setUp(): void {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }
    public function test_can_list() {
        FinalResult::factory()->count(3)->create();
        $response = $this->getJson('/api/v1/final-results');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }
    public function test_can_create() {
        $visit = Visit::factory()->create();
        $response = $this->postJson('/api/v1/final-results', [
            'visit_id' => $visit->id,
            'reason' => 'Salah input',
            'cancellation_date' => now()->toDateTimeString(),
            'requested_by' => 'Dr. Budi'
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('final_result_cancellations', ['visit_id' => $visit->id]);
    }
    public function test_can_update() {
        $fr = FinalResult::factory()->create(['reason' => 'Old']);
        $response = $this->putJson("/api/v1/final-results/{$fr->id}", ['reason' => 'New']);
        $response->assertStatus(200);
        $this->assertEquals('New', $fr->fresh()->reason);
    }
    public function test_can_delete() {
        $fr = FinalResult::factory()->create();
        $response = $this->deleteJson("/api/v1/final-results/{$fr->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('final_result_cancellations', ['id' => $fr->id]);
    }
}
