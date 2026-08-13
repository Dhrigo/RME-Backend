<?php

namespace Modules\MedicalRecordBirthCertificateLetter\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordBirthCertificateLetter\Models\BirthCertificateLetter;
use Tests\TestCase;

class BirthCertificateLetterControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_birth_certificate_letter(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/birth-certificate-letters', [
            'letter_number' => 'BIRTH/2026/001',
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'issue_date' => '2026-08-13',
            'child_name' => 'Baby John',
            'birth_weight_grams' => 3100,
            'birth_length_cm' => 48.0,
            'gender' => 'Laki-laki',
        ]);

        $response->assertCreated()->assertJsonPath('data.letter_number', 'BIRTH/2026/001');
        $this->assertDatabaseHas('birth_certificate_letters', ['letter_number' => 'BIRTH/2026/001']);
    }

    public function test_it_lists_birth_certificate_letters(): void
    {
        $this->actingUser();
        $letter = BirthCertificateLetter::factory()->create();

        $response = $this->getJson('/api/v1/birth-certificate-letters');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($letter->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_birth_certificate_letter(): void
    {
        $this->actingUser();
        $letter = BirthCertificateLetter::factory()->create();

        $response = $this->getJson("/api/v1/birth-certificate-letters/{$letter->id}");

        $response->assertOk()->assertJsonPath('data.id', $letter->id);
    }

    public function test_it_updates_a_birth_certificate_letter(): void
    {
        $this->actingUser();
        $letter = BirthCertificateLetter::factory()->create();

        $response = $this->putJson("/api/v1/birth-certificate-letters/{$letter->id}", [
            'letter_number' => $letter->letter_number,
            'patient_id' => $letter->patient_id,
            'visit_id' => $letter->visit_id,
            'doctor_id' => $letter->doctor_id,
            'issue_date' => $letter->issue_date->toDateString(),
            'remarks' => 'Updated remarks',
        ]);

        $response->assertOk()->assertJsonPath('data.remarks', 'Updated remarks');
    }

    public function test_it_deletes_a_birth_certificate_letter(): void
    {
        $this->actingUser();
        $letter = BirthCertificateLetter::factory()->create();

        $response = $this->deleteJson("/api/v1/birth-certificate-letters/{$letter->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('birth_certificate_letters', ['id' => $letter->id]);
    }
}
