<?php

namespace Modules\PendaftaranServiceHandover\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranServiceHandover\Models\ServiceHandover;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class ServiceHandoverControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pending_handover(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $ward = Ward::factory()->create();

        $response = $this->postJson('/api/v1/service-handovers', [
            'visit_id' => $visit->id,
            'ward_id' => $ward->id,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseHas('service_handovers', ['visit_id' => $visit->id, 'handed_over_by' => $user->id]);
    }

    public function test_it_receives_a_handover(): void
    {
        $this->actingUser();
        $employee = Employee::factory()->create();
        $handover = ServiceHandover::factory()->create();

        $response = $this->putJson("/api/v1/service-handovers/{$handover->id}", [
            'status' => 'received',
            'received_by' => $employee->id,
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'received');
        $this->assertNotNull($handover->fresh()->received_at);
    }

    public function test_it_rejects_a_handover_without_received_by(): void
    {
        $this->actingUser();
        $handover = ServiceHandover::factory()->create();

        $this->putJson("/api/v1/service-handovers/{$handover->id}", ['status' => 'received'])
            ->assertStatus(422);
    }

    public function test_it_cannot_reprocess_a_handover(): void
    {
        $this->actingUser();
        $handover = ServiceHandover::factory()->create(['status' => 'received']);

        $this->putJson("/api/v1/service-handovers/{$handover->id}", ['status' => 'rejected'])
            ->assertStatus(422);
    }

    public function test_guest_cannot_access_service_handovers(): void
    {
        $this->getJson('/api/v1/service-handovers')->assertStatus(401);
    }
}
