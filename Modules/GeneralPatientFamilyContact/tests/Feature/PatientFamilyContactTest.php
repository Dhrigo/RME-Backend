<?php

namespace Modules\GeneralPatientFamilyContact\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralPatientFamilyContact\Models\PatientFamilyContact;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientFamilyContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_family_contacts()
    {
        PatientFamilyContact::factory()->count(3)->create();
        $response = $this->getJson('/api/patientfamilycontacts');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_family_contact()
    {
        $data = PatientFamilyContact::factory()->make()->toArray();
        $response = $this->postJson('/api/patientfamilycontacts', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_family_contacts', ['contact_value' => $data['contact_value']]);
    }

    public function test_can_show_patient_family_contact()
    {
        $model = PatientFamilyContact::factory()->create();
        $response = $this->getJson("/api/patientfamilycontacts/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.contact_value', $model->contact_value);
    }

    public function test_can_update_patient_family_contact()
    {
        $model = PatientFamilyContact::factory()->create();
        $response = $this->putJson("/api/patientfamilycontacts/{$model->id}", [
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
        $model = PatientFamilyContact::factory()->create();
        $response = $this->deleteJson("/api/patientfamilycontacts/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_family_contacts', ['id' => $model->id]);
    }
}
