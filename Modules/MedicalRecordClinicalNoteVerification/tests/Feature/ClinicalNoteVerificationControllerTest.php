<?php

namespace Modules\MedicalRecordClinicalNoteVerification\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordClinicalNote\Models\ClinicalNote;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\MedicalRecordClinicalNoteVerification\Models\ClinicalNoteVerification;
use Tests\TestCase;

class ClinicalNoteVerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_clinical_note_verification(): void
    {
        $this->actingUser();
        $clinicalNote = ClinicalNote::factory()->create();
        $doctor = Doctor::factory()->create();

        $response = $this->postJson('/api/v1/clinical-note-verifications', [
            'clinical_note_id' => $clinicalNote->id,
            'verifier_doctor_id' => $doctor->id,
            'verification_status' => 'Verified',
            'verified_at' => '2026-08-13 17:00:00',
            'notes' => 'Approved',
        ]);

        $response->assertCreated()->assertJsonPath('data.verification_status', 'Verified');
        $this->assertDatabaseHas('clinical_note_verifications', ['clinical_note_id' => $clinicalNote->id]);
    }

    public function test_it_lists_clinical_note_verifications(): void
    {
        $this->actingUser();
        $verification = ClinicalNoteVerification::factory()->create();

        $response = $this->getJson('/api/v1/clinical-note-verifications');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($verification->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_clinical_note_verification(): void
    {
        $this->actingUser();
        $verification = ClinicalNoteVerification::factory()->create();

        $response = $this->getJson("/api/v1/clinical-note-verifications/{$verification->id}");

        $response->assertOk()->assertJsonPath('data.id', $verification->id);
    }

    public function test_it_updates_a_clinical_note_verification(): void
    {
        $this->actingUser();
        $verification = ClinicalNoteVerification::factory()->create();

        $response = $this->putJson("/api/v1/clinical-note-verifications/{$verification->id}", [
            'clinical_note_id' => $verification->clinical_note_id,
            'verifier_doctor_id' => $verification->verifier_doctor_id,
            'verified_at' => $verification->verified_at->toDateTimeString(),
            'notes' => 'Updated review notes',
        ]);

        $response->assertOk()->assertJsonPath('data.notes', 'Updated review notes');
    }

    public function test_it_deletes_a_clinical_note_verification(): void
    {
        $this->actingUser();
        $verification = ClinicalNoteVerification::factory()->create();

        $response = $this->deleteJson("/api/v1/clinical-note-verifications/{$verification->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('clinical_note_verifications', ['id' => $verification->id]);
    }
}
