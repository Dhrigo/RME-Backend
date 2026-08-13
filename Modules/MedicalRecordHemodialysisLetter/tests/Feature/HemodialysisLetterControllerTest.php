<?php

namespace Modules\MedicalRecordHemodialysisLetter\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordHemodialysisLetter\Models\HemodialysisLetter;
use Tests\TestCase;

class HemodialysisLetterControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_hemodialysis_letter(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/hemodialysis-letters', [
            'letter_number' => 'HD/2026/001',
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'doctor_id' => $doctor->id,
            'issue_date' => '2026-08-13',
            'diagnosis' => 'CKD Stage 5',
            'hd_frequency_per_week' => 2,
            'vascular_access' => 'AV Fistula',
        ]);

        $response->assertCreated()->assertJsonPath('data.letter_number', 'HD/2026/001');
        $this->assertDatabaseHas('hemodialysis_letters', ['letter_number' => 'HD/2026/001']);
    }

    public function test_it_lists_hemodialysis_letters(): void
    {
        $this->actingUser();
        $letter = HemodialysisLetter::factory()->create();

        $response = $this->getJson('/api/v1/hemodialysis-letters');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($letter->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_hemodialysis_letter(): void
    {
        $this->actingUser();
        $letter = HemodialysisLetter::factory()->create();

        $response = $this->getJson("/api/v1/hemodialysis-letters/{$letter->id}");

        $response->assertOk()->assertJsonPath('data.id', $letter->id);
    }

    public function test_it_updates_a_hemodialysis_letter(): void
    {
        $this->actingUser();
        $letter = HemodialysisLetter::factory()->create();

        $response = $this->putJson("/api/v1/hemodialysis-letters/{$letter->id}", [
            'letter_number' => $letter->letter_number,
            'patient_id' => $letter->patient_id,
            'visit_id' => $letter->visit_id,
            'doctor_id' => $letter->doctor_id,
            'issue_date' => $letter->issue_date->toDateString(),
            'remarks' => 'Updated remarks',
        ]);

        $response->assertOk()->assertJsonPath('data.remarks', 'Updated remarks');
    }

    public function test_it_deletes_a_hemodialysis_letter(): void
    {
        $this->actingUser();
        $letter = HemodialysisLetter::factory()->create();

        $response = $this->deleteJson("/api/v1/hemodialysis-letters/{$letter->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('hemodialysis_letters', ['id' => $letter->id]);
    }
}
