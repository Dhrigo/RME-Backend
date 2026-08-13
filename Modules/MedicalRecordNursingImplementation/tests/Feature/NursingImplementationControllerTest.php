<?php

namespace Modules\MedicalRecordNursingImplementation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingDiagnosis\Models\NursingDiagnosis;
use Modules\MedicalRecordNursingImplementation\Models\NursingImplementation;
use Tests\TestCase;

class NursingImplementationControllerTest extends TestCase
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
        $nursingDiagnosisId = NursingDiagnosis::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/nursing-implementations', [
            'nursing_diagnosis_id' => $nursingDiagnosisId->id,
            'performed_by' => $performedBy->id,
            'performed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('nursing_implementations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        NursingImplementation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/nursing-implementations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = NursingImplementation::factory()->create();

        $this->getJson("/api/v1/nursing-implementations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = NursingImplementation::factory()->create();

        $this->deleteJson("/api/v1/nursing-implementations/{$record->id}")->assertStatus(204);
    }
}
