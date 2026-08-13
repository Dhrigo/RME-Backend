<?php

namespace Modules\MedicalRecordHospitalizationCertificate\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordHospitalizationCertificate\Models\HospitalizationCertificate;
use Tests\TestCase;

class HospitalizationCertificateControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_hospitalization_certificate(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/hospitalization-certificates', [
            'letter_number' => 'OPNAME/2026/001',
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'issue_date' => '2026-08-13',
            'admission_date' => '2026-08-13',
            'estimated_duration_days' => 5,
            'ward_name' => 'Ruang Melati',
            'diagnosis' => 'DHF',
        ]);

        $response->assertCreated()->assertJsonPath('data.letter_number', 'OPNAME/2026/001');
        $this->assertDatabaseHas('hospitalization_certificates', ['letter_number' => 'OPNAME/2026/001']);
    }

    public function test_it_lists_hospitalization_certificates(): void
    {
        $this->actingUser();
        $certificate = HospitalizationCertificate::factory()->create();

        $response = $this->getJson('/api/v1/hospitalization-certificates');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($certificate->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_hospitalization_certificate(): void
    {
        $this->actingUser();
        $certificate = HospitalizationCertificate::factory()->create();

        $response = $this->getJson("/api/v1/hospitalization-certificates/{$certificate->id}");

        $response->assertOk()->assertJsonPath('data.id', $certificate->id);
    }

    public function test_it_updates_a_hospitalization_certificate(): void
    {
        $this->actingUser();
        $certificate = HospitalizationCertificate::factory()->create();

        $response = $this->putJson("/api/v1/hospitalization-certificates/{$certificate->id}", [
            'letter_number' => $certificate->letter_number,
            'patient_id' => $certificate->patient_id,
            'visit_id' => $certificate->visit_id,
            'doctor_id' => $certificate->doctor_id,
            'issue_date' => $certificate->issue_date->toDateString(),
            'remarks' => 'Updated remarks',
        ]);

        $response->assertOk()->assertJsonPath('data.remarks', 'Updated remarks');
    }

    public function test_it_deletes_a_hospitalization_certificate(): void
    {
        $this->actingUser();
        $certificate = HospitalizationCertificate::factory()->create();

        $response = $this->deleteJson("/api/v1/hospitalization-certificates/{$certificate->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('hospitalization_certificates', ['id' => $certificate->id]);
    }
}
