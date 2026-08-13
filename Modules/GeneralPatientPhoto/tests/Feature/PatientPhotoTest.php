<?php

namespace Modules\GeneralPatientPhoto\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientPhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        PatientPhoto::factory()->count(3)->create();
        $response = $this->getJson('/api/patient_photos');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = PatientPhoto::factory()->make()->toArray();
        $response = $this->postJson('/api/patient_photos', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('patient_photos', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = PatientPhoto::factory()->create();
        $response = $this->getJson("/api/patient_photos/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = PatientPhoto::factory()->create();
        $response = $this->putJson("/api/patient_photos/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('patient_photos', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = PatientPhoto::factory()->create();
        $response = $this->deleteJson("/api/patient_photos/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('patient_photos', ['id' => $model->id]);
    }
}
