<?php

namespace Modules\MedicalRecordPatientFamilyEducation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPatientFamilyEducation\Models\PatientFamilyEducation;
use Tests\TestCase;

class PatientFamilyEducationControllerTest extends TestCase
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
        $educatorId = Employee::factory()->create();

        $response = $this->postJson('/api/v1/patient-family-educations', [
            'visit_id' => $visitId->id,
            'topic' => 'Test value',
            'educator_id' => $educatorId->id,
            'educated_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('patient_family_educations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PatientFamilyEducation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/patient-family-educations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PatientFamilyEducation::factory()->create();

        $this->getJson("/api/v1/patient-family-educations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PatientFamilyEducation::factory()->create();

        $this->deleteJson("/api/v1/patient-family-educations/{$record->id}")->assertStatus(204);
    }
}
