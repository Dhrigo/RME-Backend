<?php

namespace Modules\MedicalRecordMorseFallScaleAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordMorseFallScaleAssessment\Models\MorseFallScaleAssessment;
use Tests\TestCase;

class MorseFallScaleAssessmentControllerTest extends TestCase
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
        $assessedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/morse-fall-scale-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'history_of_falling' => fake()->randomElement([0,25]),
            'secondary_diagnosis' => fake()->randomElement([0,15]),
            'ambulatory_aid' => fake()->randomElement([0,15,30]),
            'iv_therapy' => fake()->randomElement([0,20]),
            'gait' => fake()->randomElement([0,10,20]),
            'mental_status' => fake()->randomElement([0,15]),
            'total_score' => fake()->numberBetween(0,125),
            'risk_level' => fake()->randomElement(['LOW','MODERATE','HIGH']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('morse_fall_scale_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        MorseFallScaleAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/morse-fall-scale-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/morse-fall-scale-assessments')->assertStatus(401);
    }
}
