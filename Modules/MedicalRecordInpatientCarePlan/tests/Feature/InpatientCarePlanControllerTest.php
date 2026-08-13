<?php

namespace Modules\MedicalRecordInpatientCarePlan\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInpatientCarePlan\Models\InpatientCarePlan;
use Tests\TestCase;

class InpatientCarePlanControllerTest extends TestCase
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
        $plannedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/inpatient-care-plans', [
            'visit_id' => $visit->id,
            'planned_by' => $plannedBy->id,
            'care_goals' => fake()->sentence(10),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('inpatient_care_plans', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        InpatientCarePlan::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/inpatient-care-plans');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/inpatient-care-plans')->assertStatus(401);
    }
}
