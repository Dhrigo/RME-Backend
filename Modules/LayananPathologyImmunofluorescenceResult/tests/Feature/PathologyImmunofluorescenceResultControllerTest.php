<?php

namespace Modules\LayananPathologyImmunofluorescenceResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPathologyImmunofluorescenceResult\Models\PathologyImmunofluorescenceResult;
use Tests\TestCase;

class PathologyImmunofluorescenceResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_pa_if_results(): void
    {
        $this->actingUser();
        PathologyImmunofluorescenceResult::factory()->count(3)->create();

        $this->getJson('/api/v1/pathology-immunofluorescence-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_pa_if_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pathology-immunofluorescence-results', [
            'pathology_anatomy_result_id' => \Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult::factory()->create()->id,
            'marker' => 'Test Marker',
            'result' => 'Test Result',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('pathology_immunofluorescence_results', 1);
    }

}
