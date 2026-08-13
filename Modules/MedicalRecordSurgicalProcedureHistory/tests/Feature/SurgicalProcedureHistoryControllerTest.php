<?php

namespace Modules\MedicalRecordSurgicalProcedureHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordSurgicalProcedureHistory\Models\SurgicalProcedureHistory;
use Tests\TestCase;

class SurgicalProcedureHistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();

        $response = $this->postJson('/api/v1/surgical-procedure-histories', [
            'visit_id' => $visit->id,
            'procedure_name' => fake()->words(3,true),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('surgical_procedure_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        SurgicalProcedureHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/surgical-procedure-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/surgical-procedure-histories')->assertStatus(401);
    }
}
