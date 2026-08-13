<?php

namespace Modules\MedicalRecordRiskFactor\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordRiskFactor\Models\RiskFactor;
use Tests\TestCase;

class RiskFactorControllerTest extends TestCase
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
        $identifiedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/risk-factors', [
            'visit_id' => $visitId->id,
            'risk_category' => 'Test value',
            'identified_by' => $identifiedBy->id,
            'identified_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('risk_factors', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        RiskFactor::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/risk-factors');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = RiskFactor::factory()->create();

        $this->getJson("/api/v1/risk-factors/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = RiskFactor::factory()->create();

        $this->deleteJson("/api/v1/risk-factors/{$record->id}")->assertStatus(204);
    }
}
