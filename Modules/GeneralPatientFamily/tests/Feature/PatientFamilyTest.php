<?php

namespace Modules\GeneralPatientFamily\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientFamilyTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_patient_families()
    {
        PatientFamily::factory()->count(3)->create();
        $response = $this->getJson('/api/patientfamilies');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_patient_family()
    {
        $data = PatientFamily::factory()->make()->toArray();
        $response = $this->postJson('/api/patientfamilies', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_families', ['name' => $data['name']]);
    }

    public function test_can_show_patient_family()
    {
        $model = PatientFamily::factory()->create();
        $response = $this->getJson("/api/patientfamilies/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update_patient_family()
    {
        $model = PatientFamily::factory()->create();
        $response = $this->putJson("/api/patientfamilies/{$model->id}", [
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
        $model = PatientFamily::factory()->create();
        $response = $this->deleteJson("/api/patientfamilies/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_families', ['id' => $model->id]);
    }
}
