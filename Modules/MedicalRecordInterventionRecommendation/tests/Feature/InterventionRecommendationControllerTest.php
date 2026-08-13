<?php

namespace Modules\MedicalRecordInterventionRecommendation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordInterventionRecommendation\Models\InterventionRecommendation;
use Tests\TestCase;

class InterventionRecommendationControllerTest extends TestCase
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
        $recommendedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/intervention-recommendations', [
            'visit_id' => $visitId->id,
            'recommended_by' => $recommendedBy->id,
            'recommended_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('intervention_recommendations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        InterventionRecommendation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/intervention-recommendations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = InterventionRecommendation::factory()->create();

        $this->getJson("/api/v1/intervention-recommendations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = InterventionRecommendation::factory()->create();

        $this->deleteJson("/api/v1/intervention-recommendations/{$record->id}")->assertStatus(204);
    }
}
