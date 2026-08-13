<?php

namespace Modules\MedicalRecordExternalRiskFactor\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordExternalRiskFactor\Models\ExternalRiskFactor;
use Tests\TestCase;

class ExternalRiskFactorControllerTest extends TestCase
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
        $recordedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/external-risk-factors', [
            'visit_id' => $visitId->id,
            'factor_type' => 'Test value',
            'recorded_by' => $recordedBy->id,
            'recorded_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('external_risk_factors', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ExternalRiskFactor::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/external-risk-factors');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ExternalRiskFactor::factory()->create();

        $this->getJson("/api/v1/external-risk-factors/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ExternalRiskFactor::factory()->create();

        $this->deleteJson("/api/v1/external-risk-factors/{$record->id}")->assertStatus(204);
    }
}
