<?php

namespace Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Models\HumptyDumptyFallScaleAssessment;
use Tests\TestCase;

class HumptyDumptyFallScaleAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/humpty-dumpty-fall-scale-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'age_score' => fake()->numberBetween(1,4),
            'gender_score' => fake()->numberBetween(1,3),
            'diagnosis_score' => fake()->numberBetween(1,4),
            'cognitive_impairment_score' => fake()->numberBetween(1,3),
            'environmental_score' => fake()->numberBetween(1,4),
            'surgery_sedation_score' => fake()->numberBetween(1,3),
            'medication_score' => fake()->numberBetween(1,3),
            'total_score' => fake()->numberBetween(7,23),
            'risk_level' => fake()->randomElement(['LOW','HIGH']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('humpty_dumpty_fall_scale_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        HumptyDumptyFallScaleAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/humpty-dumpty-fall-scale-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/humpty-dumpty-fall-scale-assessments')->assertStatus(401);
    }
}
