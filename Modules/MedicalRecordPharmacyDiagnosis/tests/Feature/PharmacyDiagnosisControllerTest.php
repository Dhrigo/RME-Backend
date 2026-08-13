<?php

namespace Modules\MedicalRecordPharmacyDiagnosis\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPharmacyDiagnosis\Models\PharmacyDiagnosis;
use Tests\TestCase;

class PharmacyDiagnosisControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $visitId = Visit::factory()->create();
        $assessedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/pharmacy-diagnoses', [
            'visit_id' => $visitId->id,
            'problem_category' => 'Test value',
            'assessed_by' => $assessedBy->id,
            'assessed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('pharmacy_diagnoses', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PharmacyDiagnosis::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pharmacy-diagnoses');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyDiagnosis::factory()->create();

        $this->getJson("/api/v1/pharmacy-diagnoses/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyDiagnosis::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-diagnoses/{$record->id}")->assertStatus(204);
    }
}
