<?php

namespace Modules\MedicalRecordSurgery\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordSurgery\Models\Surgery;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class SurgeryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_schedules_a_surgery(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $surgeon = Employee::factory()->create();

        $response = $this->postJson('/api/v1/surgeries', [
            'visit_id' => $visit->id,
            'surgeon_id' => $surgeon->id,
            'procedure_name' => 'Appendectomy',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'scheduled');
        $this->assertDatabaseHas('surgeries', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_surgeries_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        Surgery::factory()->count(2)->create(['visit_id' => $visit->id]);
        Surgery::factory()->create();

        $response = $this->getJson("/api/v1/surgeries?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_completes_a_surgery(): void
    {
        $this->actingUser();
        $surgery = Surgery::factory()->create(['status' => 'in_progress']);

        $response = $this->putJson("/api/v1/surgeries/{$surgery->id}", [
            'status' => 'completed',
            'ended_at' => now()->toIso8601String(),
        ]);

        $response->assertOk()->assertJsonPath('data.status', 'completed');
    }

    public function test_guest_cannot_access_surgeries(): void
    {
        $this->getJson('/api/v1/surgeries')->assertStatus(401);
    }
}
