<?php

namespace Modules\MedicalRecordMedicationAdministrationHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordMedicationAdministrationHistory\Models\MedicationAdministrationHistory;
use Tests\TestCase;

class MedicationAdministrationHistoryControllerTest extends TestCase
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
        $administeredBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/medication-admin-histories', [
            'visit_id' => $visit->id,
            'administered_by' => $administeredBy->id,
            'drug_name' => fake()->word(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('medication_administration_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        MedicationAdministrationHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/medication-admin-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/medication-admin-histories')->assertStatus(401);
    }
}
