<?php

namespace Modules\GeneralPatientFamily\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Tests\TestCase;

class PatientFamilyTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_can_list_patient_families()
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        PatientFamily::factory()->count(3)->create(['patient_id' => $patient->id]);

        $response = $this->getJson("/api/v1/patient-families?patient_id={$patient->id}");
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_family()
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $data = PatientFamily::factory()->make(['patient_id' => $patient->id])->toArray();

        $response = $this->postJson('/api/v1/patient-families', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_families', ['name' => $data['name']]);
    }

    public function test_can_show_patient_family()
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $model = PatientFamily::factory()->create(['patient_id' => $patient->id]);

        $response = $this->getJson("/api/v1/patient-families/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update_patient_family()
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $model = PatientFamily::factory()->create(['patient_id' => $patient->id]);

        $response = $this->putJson("/api/v1/patient-families/{$model->id}", [
            'name' => 'Updated Name',
            'relationship' => 'Ibu',
            'patient_id' => $model->patient_id,
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patient_families', ['name' => 'Updated Name']);
    }

    public function test_can_delete_patient_family()
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $model = PatientFamily::factory()->create(['patient_id' => $patient->id]);

        $response = $this->deleteJson("/api/v1/patient-families/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_families', ['id' => $model->id]);
    }

    public function test_guest_cannot_access_patient_families(): void
    {
        $this->getJson('/api/v1/patient-families')->assertStatus(401);
    }
}
