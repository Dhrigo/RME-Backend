<?php

namespace Modules\MedicalRecordPlanAndTherapy\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPlanAndTherapy\Models\PlanAndTherapy;
use Tests\TestCase;

class PlanAndTherapyControllerTest extends TestCase
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
        $orderedBy = \Modules\GeneralDoctor\Models\Doctor::factory()->create();

        $response = $this->postJson('/api/v1/plan-and-therapies', [
            'visit_id' => $visit->id,
            'ordered_by' => $orderedBy->id,
            'plan_description' => fake()->sentence(10),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('plan_and_therapies', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PlanAndTherapy::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/plan-and-therapies');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/plan-and-therapies')->assertStatus(401);
    }
}
