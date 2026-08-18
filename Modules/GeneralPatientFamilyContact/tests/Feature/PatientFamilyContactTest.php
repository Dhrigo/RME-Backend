<?php

namespace Modules\GeneralPatientFamilyContact\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Modules\GeneralPatientFamilyContact\Models\PatientFamilyContact;
use Tests\TestCase;

class PatientFamilyContactTest extends TestCase
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

    public function test_can_list_patient_family_contacts()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        PatientFamilyContact::factory()->count(3)->create(['patient_family_id' => $family->id]);

        $response = $this->getJson("/api/v1/patient-family-contacts?patient_family_id={$family->id}");
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_family_contact()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $data = PatientFamilyContact::factory()->make(['patient_family_id' => $family->id])->toArray();

        $response = $this->postJson('/api/v1/patient-family-contacts', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_family_contacts', ['contact_value' => $data['contact_value']]);
    }

    public function test_can_show_patient_family_contact()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $model = PatientFamilyContact::factory()->create(['patient_family_id' => $family->id]);

        $response = $this->getJson("/api/v1/patient-family-contacts/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.contact_value', $model->contact_value);
    }

    public function test_can_update_patient_family_contact()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $model = PatientFamilyContact::factory()->create(['patient_family_id' => $family->id]);

        $response = $this->putJson("/api/v1/patient-family-contacts/{$model->id}", [
            'patient_family_id' => $model->patient_family_id,
            'contact_type' => 'Email',
            'contact_value' => 'test@example.com',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patient_family_contacts', ['contact_value' => 'test@example.com']);
    }

    public function test_can_delete_patient_family_contact()
    {
        $this->actingUser();
        $family = $this->makeFamily();
        $model = PatientFamilyContact::factory()->create(['patient_family_id' => $family->id]);

        $response = $this->deleteJson("/api/v1/patient-family-contacts/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_family_contacts', ['id' => $model->id]);
    }

    public function test_guest_cannot_access_patient_family_contacts(): void
    {
        $this->getJson('/api/v1/patient-family-contacts')->assertStatus(401);
    }
}
