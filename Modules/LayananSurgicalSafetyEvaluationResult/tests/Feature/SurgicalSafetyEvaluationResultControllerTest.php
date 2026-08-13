<?php

namespace Modules\LayananSurgicalSafetyEvaluationResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananSurgicalSafetyEvaluationResult\Models\SurgicalSafetyEvaluationResult;
use Tests\TestCase;

class SurgicalSafetyEvaluationResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_sst_results(): void
    {
        $this->actingUser();
        SurgicalSafetyEvaluationResult::factory()->count(3)->create();

        $this->getJson('/api/v1/surgical-safety-evaluation-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_sst_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/surgical-safety-evaluation-results', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'checklist_score' => 5,
            'evaluated_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('surgical_safety_evaluation_results', 1);
    }

}
