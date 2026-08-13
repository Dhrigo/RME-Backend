<?php

namespace Modules\MedicalRecordParentalHealthHistoryScreening\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordParentalHealthHistoryScreening\Models\ParentalHealthHistoryScreening;
use Tests\TestCase;

class ParentalHealthHistoryScreeningControllerTest extends TestCase
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
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $screenedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/parental-health-history-screenings', [
            'visit_id' => $visit->id,
            'screened_by' => $screenedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('parental_health_history_screenings', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ParentalHealthHistoryScreening::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/parental-health-history-screenings');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/parental-health-history-screenings')->assertStatus(401);
    }
}
