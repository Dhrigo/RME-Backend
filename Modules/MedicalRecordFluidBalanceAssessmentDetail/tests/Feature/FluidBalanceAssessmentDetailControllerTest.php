<?php

namespace Modules\MedicalRecordFluidBalanceAssessmentDetail\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFluidBalanceAssessment\Models\FluidBalanceAssessment;
use Modules\MedicalRecordFluidBalanceAssessmentDetail\Models\FluidBalanceAssessmentDetail;
use Tests\TestCase;

class FluidBalanceAssessmentDetailControllerTest extends TestCase
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
        $parent = FluidBalanceAssessment::factory()->create();

        $payload = [
            'fluid_balance_assessment_id' => $parent->id,
            'type' => 'intake',
            'category' => 'oral',
            'amount_ml' => 200.00,
        ];

        $response = $this->postJson('/api/v1/fluid-balance-assessment-details', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.type', 'intake');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        FluidBalanceAssessmentDetail::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/fluid-balance-assessment-details');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = FluidBalanceAssessmentDetail::factory()->create();

        $response = $this->getJson("/api/v1/fluid-balance-assessment-details/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = FluidBalanceAssessmentDetail::factory()->create();

        $response = $this->putJson("/api/v1/fluid-balance-assessment-details/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = FluidBalanceAssessmentDetail::factory()->create();

        $response = $this->deleteJson("/api/v1/fluid-balance-assessment-details/{$record->id}");

        $response->assertNoContent();
    }
}
