<?php

namespace Modules\MedicalRecordSickLeaveCertificate\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordSickLeaveCertificate\Models\SickLeaveCertificate;
use Tests\TestCase;

class SickLeaveCertificateControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_sick_leave_certificate(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/sick-leave-certificates', [
            'letter_number' => 'SK/2026/001',
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'issue_date' => '2026-08-13',
            'start_date' => '2026-08-13',
            'end_date' => '2026-08-15',
            'duration_days' => 3,
            'diagnosis' => 'Flu',
        ]);

        $response->assertCreated()->assertJsonPath('data.letter_number', 'SK/2026/001');
        $this->assertDatabaseHas('sick_leave_certificates', ['letter_number' => 'SK/2026/001']);
    }

    public function test_it_lists_sick_leave_certificates(): void
    {
        $this->actingUser();
        $certificate = SickLeaveCertificate::factory()->create();

        $response = $this->getJson('/api/v1/sick-leave-certificates');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($certificate->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_sick_leave_certificate(): void
    {
        $this->actingUser();
        $certificate = SickLeaveCertificate::factory()->create();

        $response = $this->getJson("/api/v1/sick-leave-certificates/{$certificate->id}");

        $response->assertOk()->assertJsonPath('data.id', $certificate->id);
    }

    public function test_it_updates_a_sick_leave_certificate(): void
    {
        $this->actingUser();
        $certificate = SickLeaveCertificate::factory()->create();

        $response = $this->putJson("/api/v1/sick-leave-certificates/{$certificate->id}", [
            'letter_number' => $certificate->letter_number,
            'patient_id' => $certificate->patient_id,
            'visit_id' => $certificate->visit_id,
            'doctor_id' => $certificate->doctor_id,
            'issue_date' => $certificate->issue_date->toDateString(),
            'start_date' => $certificate->start_date->toDateString(),
            'end_date' => $certificate->end_date->toDateString(),
            'duration_days' => $certificate->duration_days,
            'remarks' => 'Updated remarks',
        ]);

        $response->assertOk()->assertJsonPath('data.remarks', 'Updated remarks');
    }

    public function test_it_deletes_a_sick_leave_certificate(): void
    {
        $this->actingUser();
        $certificate = SickLeaveCertificate::factory()->create();

        $response = $this->deleteJson("/api/v1/sick-leave-certificates/{$certificate->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('sick_leave_certificates', ['id' => $certificate->id]);
    }
}
