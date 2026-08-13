<?php

namespace Modules\MedicalRecordDischargePlanningScreening\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordDischargePlanningScreening\Models\DischargePlanningScreening;
use Tests\TestCase;

class DischargePlanningScreeningControllerTest extends TestCase
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
        $screenedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/discharge-planning-screenings', [
            'visit_id' => $visitId->id,
            'screened_by' => $screenedBy->id,
            'screened_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('discharge_planning_screenings', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        DischargePlanningScreening::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/discharge-planning-screenings');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = DischargePlanningScreening::factory()->create();

        $this->getJson("/api/v1/discharge-planning-screenings/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = DischargePlanningScreening::factory()->create();

        $this->deleteJson("/api/v1/discharge-planning-screenings/{$record->id}")->assertStatus(204);
    }
}
