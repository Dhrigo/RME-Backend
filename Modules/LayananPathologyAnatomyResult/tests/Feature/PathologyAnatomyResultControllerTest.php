<?php

namespace Modules\LayananPathologyAnatomyResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult;
use Tests\TestCase;

class PathologyAnatomyResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_pa_results(): void
    {
        $this->actingUser();
        PathologyAnatomyResult::factory()->count(3)->create();

        $this->getJson('/api/v1/pathology-anatomy-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_pa_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pathology-anatomy-results', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'specimen_description' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('pathology_anatomy_results', 1);
    }

    public function test_it_shows_pa_result(): void
    {
        $this->actingUser();
        $pa_result = PathologyAnatomyResult::factory()->create();

        $this->getJson("/api/v1/pathology-anatomy-results/{$pa_result->id}")->assertOk()->assertJsonPath('data.id', $pa_result->id);
    }

}
