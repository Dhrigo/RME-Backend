<?php

namespace Modules\GeneralAdmissionDiagnosis\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAdmissionDiagnosis\Models\AdmissionDiagnosis;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class AdmissionDiagnosisControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_admission_diagnosis(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        $diagnosisCode = DiagnosisCode::factory()->create();

        $response = $this->postJson('/api/v1/admission-diagnoses', [
            'visit_id' => $visit->id,
            'diagnosis_code_id' => $diagnosisCode->id,
            'diagnosis_text' => 'Demam Berdarah Dengue',
        ]);

        $response->assertCreated()->assertJsonPath('data.diagnosis_text', 'Demam Berdarah Dengue');
        $this->assertDatabaseHas('admission_diagnoses', ['visit_id' => $visit->id, 'diagnosis_code_id' => $diagnosisCode->id]);
    }

    public function test_it_lists_diagnoses_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        AdmissionDiagnosis::factory()->create(['visit_id' => $visit->id]);
        AdmissionDiagnosis::factory()->create();

        $response = $this->getJson("/api/v1/admission-diagnoses?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_updates_a_diagnosis(): void
    {
        $this->actingUser();
        $diagnosis = AdmissionDiagnosis::factory()->create();

        $this->putJson("/api/v1/admission-diagnoses/{$diagnosis->id}", ['diagnosis_text' => 'Gastroenteritis Akut'])
            ->assertOk()
            ->assertJsonPath('data.diagnosis_text', 'Gastroenteritis Akut');
    }

    public function test_store_requires_visit_and_diagnosis_code(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/admission-diagnoses', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['visit_id', 'diagnosis_code_id']);
    }

    public function test_it_deletes_a_diagnosis(): void
    {
        $this->actingUser();
        $diagnosis = AdmissionDiagnosis::factory()->create();

        $this->deleteJson("/api/v1/admission-diagnoses/{$diagnosis->id}")->assertStatus(204);
        $this->assertDatabaseMissing('admission_diagnoses', ['id' => $diagnosis->id]);
    }

    public function test_guest_cannot_access_admission_diagnoses(): void
    {
        $this->getJson('/api/v1/admission-diagnoses')->assertStatus(401);
    }
}
