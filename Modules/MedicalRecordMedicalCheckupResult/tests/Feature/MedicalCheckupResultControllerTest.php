<?php

namespace Modules\MedicalRecordMedicalCheckupResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordMedicalCheckupResult\Models\MedicalCheckupResult;
use Tests\TestCase;

class MedicalCheckupResultControllerTest extends TestCase
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
        $patientId = Patient::factory()->create();
        $examinedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/medical-checkup-results', [
            'patient_id' => $patientId->id,
            'checkup_date' => now()->toDateTimeString(),
            'examined_by' => $examinedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('medical_checkup_results', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        MedicalCheckupResult::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/medical-checkup-results');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = MedicalCheckupResult::factory()->create();

        $this->getJson("/api/v1/medical-checkup-results/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = MedicalCheckupResult::factory()->create();

        $this->deleteJson("/api/v1/medical-checkup-results/{$record->id}")->assertStatus(204);
    }
}
