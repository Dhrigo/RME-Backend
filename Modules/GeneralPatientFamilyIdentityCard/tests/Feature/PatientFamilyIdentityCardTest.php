<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Modules\GeneralPatientFamilyIdentityCard\Models\PatientFamilyIdentityCard;
use Tests\TestCase;

class PatientFamilyIdentityCardTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    private function makeFamily(): PatientFamily
    {
        $patient = Patient::factory()->create();

        return PatientFamily::factory()->create(['patient_id' => $patient->id]);
    }

    public function test_can_list_patient_family_identity_cards()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        PatientFamilyIdentityCard::factory()->count(3)->create(['patient_family_id' => $family->id]);

        $response = $this->getJson("/api/v1/patient-family-identity-cards?patient_family_id={$family->id}");
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_family_identity_card()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $data = PatientFamilyIdentityCard::factory()->make(['patient_family_id' => $family->id])->toArray();

        $response = $this->postJson('/api/v1/patient-family-identity-cards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_family_identity_cards', ['identity_number' => $data['identity_number']]);
    }

    public function test_can_show_patient_family_identity_card()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $model = PatientFamilyIdentityCard::factory()->create(['patient_family_id' => $family->id]);

        $response = $this->getJson("/api/v1/patient-family-identity-cards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.identity_number', $model->identity_number);
    }

    public function test_can_update_patient_family_identity_card()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $model = PatientFamilyIdentityCard::factory()->create(['patient_family_id' => $family->id]);

        $response = $this->putJson("/api/v1/patient-family-identity-cards/{$model->id}", [
            'patient_family_id' => $model->patient_family_id,
            'identity_type' => 'SIM',
            'identity_number' => '1234567890',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patient_family_identity_cards', ['identity_number' => '1234567890']);
    }

    public function test_can_delete_patient_family_identity_card()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $model = PatientFamilyIdentityCard::factory()->create(['patient_family_id' => $family->id]);

        $response = $this->deleteJson("/api/v1/patient-family-identity-cards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_family_identity_cards', ['id' => $model->id]);
    }

    public function test_guest_cannot_access_patient_family_identity_cards(): void
    {
        $this->getJson('/api/v1/patient-family-identity-cards')->assertStatus(401);
    }
}
