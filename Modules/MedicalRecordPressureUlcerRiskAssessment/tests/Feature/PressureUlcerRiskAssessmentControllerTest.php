<?php

namespace Modules\MedicalRecordPressureUlcerRiskAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Models\PressureUlcerRiskAssessment;
use Tests\TestCase;

class PressureUlcerRiskAssessmentControllerTest extends TestCase
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

        $payload = [
            'visit_id' => 1,
        ];

        $response = $this->postJson('/api/v1/pressure-ulcer-risk-assessments', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PressureUlcerRiskAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pressure-ulcer-risk-assessments');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PressureUlcerRiskAssessment::factory()->create();

        $response = $this->getJson("/api/v1/pressure-ulcer-risk-assessments/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = PressureUlcerRiskAssessment::factory()->create();

        $response = $this->putJson("/api/v1/pressure-ulcer-risk-assessments/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PressureUlcerRiskAssessment::factory()->create();

        $response = $this->deleteJson("/api/v1/pressure-ulcer-risk-assessments/{$record->id}");

        $response->assertNoContent();
    }
}
