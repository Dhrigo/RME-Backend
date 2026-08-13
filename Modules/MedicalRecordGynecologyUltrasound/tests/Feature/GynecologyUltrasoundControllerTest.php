<?php

namespace Modules\MedicalRecordGynecologyUltrasound\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordGynecologyUltrasound\Models\GynecologyUltrasound;
use Tests\TestCase;

class GynecologyUltrasoundControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_gynecology_ultrasound(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/gynecology-ultrasounds', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'exam_date' => '2026-08-13 15:00:00',
            'uterus_findings' => 'Normal uterus',
            'endometrial_thickness_mm' => 8.5,
            'conclusion' => 'Normal USG',
        ]);

        $response->assertCreated()->assertJsonPath('data.uterus_findings', 'Normal uterus');
        $this->assertDatabaseHas('gynecology_ultrasounds', ['patient_id' => $patient->id]);
    }

    public function test_it_lists_gynecology_ultrasounds(): void
    {
        $this->actingUser();
        $ultrasound = GynecologyUltrasound::factory()->create();

        $response = $this->getJson('/api/v1/gynecology-ultrasounds');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($ultrasound->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_gynecology_ultrasound(): void
    {
        $this->actingUser();
        $ultrasound = GynecologyUltrasound::factory()->create();

        $response = $this->getJson("/api/v1/gynecology-ultrasounds/{$ultrasound->id}");

        $response->assertOk()->assertJsonPath('data.id', $ultrasound->id);
    }

    public function test_it_updates_a_gynecology_ultrasound(): void
    {
        $this->actingUser();
        $ultrasound = GynecologyUltrasound::factory()->create();

        $response = $this->putJson("/api/v1/gynecology-ultrasounds/{$ultrasound->id}", [
            'patient_id' => $ultrasound->patient_id,
            'visit_id' => $ultrasound->visit_id,
            'exam_date' => $ultrasound->exam_date->toDateTimeString(),
            'conclusion' => 'Updated conclusion',
        ]);

        $response->assertOk()->assertJsonPath('data.conclusion', 'Updated conclusion');
    }

    public function test_it_deletes_a_gynecology_ultrasound(): void
    {
        $this->actingUser();
        $ultrasound = GynecologyUltrasound::factory()->create();

        $response = $this->deleteJson("/api/v1/gynecology-ultrasounds/{$ultrasound->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('gynecology_ultrasounds', ['id' => $ultrasound->id]);
    }
}
