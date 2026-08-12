<?php

namespace Modules\MedicalRecordAllergy\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\MedicalRecordAllergy\Models\Allergy;
use Tests\TestCase;

class AllergyControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_patient_allergy(): void
    {
        $user = $this->actingUser();
        $patient = Patient::factory()->create();
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/allergies', [
            'patient_id' => $patient->id,
            'recorded_by' => $recordedBy->id,
            'category' => 'drug',
            'allergen' => 'Penicillin',
            'severity' => 'severe',
        ]);

        $response->assertCreated()->assertJsonPath('data.allergen', 'Penicillin');
        $this->assertDatabaseHas('allergies', ['patient_id' => $patient->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_active_allergies_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        Allergy::factory()->create(['patient_id' => $patient->id, 'is_active' => true]);
        Allergy::factory()->create(['patient_id' => $patient->id, 'is_active' => false]);
        Allergy::factory()->create();

        $response = $this->getJson("/api/v1/allergies?patient_id={$patient->id}&active_only=1");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_deactivates_an_allergy(): void
    {
        $this->actingUser();
        $allergy = Allergy::factory()->create(['is_active' => true]);

        $response = $this->putJson("/api/v1/allergies/{$allergy->id}", ['is_active' => false]);

        $response->assertOk()->assertJsonPath('data.is_active', false);
    }

    public function test_guest_cannot_access_allergies(): void
    {
        $this->getJson('/api/v1/allergies')->assertStatus(401);
    }
}
