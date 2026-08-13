<?php

namespace Modules\MedicalRecordPainScoreAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPainScoreAssessment\Models\PainScoreAssessment;
use Tests\TestCase;

class PainScoreAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/pain-score-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'scale_type' => fake()->randomElement(['NRS','WONG_BAKER','FLACC','CRIES']),
            'score' => fake()->numberBetween(0,10),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('pain_score_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PainScoreAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pain-score-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/pain-score-assessments')->assertStatus(401);
    }
}
