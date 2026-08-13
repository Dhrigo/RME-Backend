<?php

namespace Modules\MedicalRecordEmergencyEducation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordEmergencyEducation\Models\EmergencyEducation;
use Tests\TestCase;

class EmergencyEducationControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/emergency-educations', [
            'visit_id' => $visitId->id,
            'topic' => 'Test value',
            'educator_id' => $educatorId->id,
            'educated_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('emergency_educations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        EmergencyEducation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/emergency-educations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = EmergencyEducation::factory()->create();

        $this->getJson("/api/v1/emergency-educations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = EmergencyEducation::factory()->create();

        $this->deleteJson("/api/v1/emergency-educations/{$record->id}")->assertStatus(204);
    }
}
