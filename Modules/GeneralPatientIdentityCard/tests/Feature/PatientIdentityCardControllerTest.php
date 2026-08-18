<?php

namespace Modules\GeneralPatientIdentityCard\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientIdentityCard\Models\PatientIdentityCard;
use Tests\TestCase;

class PatientIdentityCardControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_patient_identity_card(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/patient-identity-cards', [
            'patient_id' => $patient->id,
            'id_type' => 'KTP',
            'id_number' => '3201234567890001',
            'issued_at' => '2020-01-10',
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.id_type', 'KTP');
        $response->assertJsonPath('data.id_number', '3201234567890001');
    }

    public function test_it_rejects_invalid_id_type(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/patient-identity-cards', [
            'patient_id' => $patient->id,
            'id_type' => 'NPWP',
            'id_number' => '3201234567890001',
        ]);

        $response->assertStatus(422);
    }

    public function test_it_lists_cards_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        PatientIdentityCard::factory()->count(2)->create(['patient_id' => $patient->id]);
        PatientIdentityCard::factory()->create();

        $response = $this->getJson("/api/v1/patient-identity-cards?patient_id={$patient->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_updates_a_card(): void
    {
        $this->actingUser();
        $card = PatientIdentityCard::factory()->create(['id_type' => 'KTP']);

        $response = $this->putJson("/api/v1/patient-identity-cards/{$card->id}", ['id_type' => 'SIM']);

        $response->assertOk()->assertJsonPath('data.id_type', 'SIM');
    }

    public function test_it_deletes_a_card(): void
    {
        $this->actingUser();
        $card = PatientIdentityCard::factory()->create();

        $this->deleteJson("/api/v1/patient-identity-cards/{$card->id}")->assertNoContent();
        $this->assertDatabaseMissing('patient_identity_cards', ['id' => $card->id]);
    }

    public function test_guest_cannot_access_patient_identity_cards(): void
    {
        $this->getJson('/api/v1/patient-identity-cards')->assertStatus(401);
    }
}
