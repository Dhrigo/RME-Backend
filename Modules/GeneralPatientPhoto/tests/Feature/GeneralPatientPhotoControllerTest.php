<?php

namespace Modules\GeneralPatientPhoto\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;
use Tests\TestCase;

class GeneralPatientPhotoControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_patient_photo(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/patient-photos', [
            'patient_id' => $patient->id,
            'file_path' => 'patient-photos/001.jpg',
            'taken_at' => now()->toIso8601String(),
        ])
            ->assertCreated()
            ->assertJsonPath('file_path', 'patient-photos/001.jpg');
    }

    public function test_it_lists_photos_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        PatientPhoto::factory()->count(2)->create(['patient_id' => $patient->id]);
        PatientPhoto::factory()->create();

        $this->getJson("/api/v1/patient-photos?patient_id={$patient->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patient-photos', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['patient_id', 'file_path', 'taken_at']);
    }

    public function test_it_updates_patient_photo(): void
    {
        $this->actingUser();
        $photo = PatientPhoto::factory()->create(['file_path' => 'patient-photos/old.jpg']);

        $this->putJson("/api/v1/patient-photos/{$photo->id}", ['file_path' => 'patient-photos/new.jpg'])
            ->assertOk()
            ->assertJsonPath('file_path', 'patient-photos/new.jpg');
    }

    public function test_it_deletes_patient_photo(): void
    {
        $this->actingUser();
        $photo = PatientPhoto::factory()->create();

        $this->deleteJson("/api/v1/patient-photos/{$photo->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('patient_photos', ['id' => $photo->id]);
    }
}
