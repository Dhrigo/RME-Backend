<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingIndicator\Models\NursingIndicator;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordNursingIndicatorImplementation\Models\NursingIndicatorImplementation;
use Tests\TestCase;

class NursingIndicatorImplementationControllerTest extends TestCase
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
        $nursingIndicatorId = NursingIndicator::factory()->create();
        $visitId = Visit::factory()->create();
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/nursing-indicator-implementations', [
            'nursing_indicator_id' => $nursingIndicatorId->id,
            'visit_id' => $visitId->id,
            'value_recorded' => 'Test value',
            'recorded_by' => $recordedBy->id,
            'recorded_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('nursing_indicator_implementations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        NursingIndicatorImplementation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/nursing-indicator-implementations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = NursingIndicatorImplementation::factory()->create();

        $this->getJson("/api/v1/nursing-indicator-implementations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = NursingIndicatorImplementation::factory()->create();

        $this->deleteJson("/api/v1/nursing-indicator-implementations/{$record->id}")->assertStatus(204);
    }
}
