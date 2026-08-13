<?php

namespace Modules\LayananPathologyMolecularResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPathologyMolecularResult\Models\PathologyMolecularResult;
use Tests\TestCase;

class PathologyMolecularResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_pa_mol_results(): void
    {
        $this->actingUser();
        PathologyMolecularResult::factory()->count(3)->create();

        $this->getJson('/api/v1/pathology-molecular-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_pa_mol_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pathology-molecular-results', [
            'pathology_anatomy_result_id' => \Modules\LayananPathologyAnatomyResult\Models\PathologyAnatomyResult::factory()->create()->id,
            'test_name' => 'Test Test_name',
            'result' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('pathology_molecular_results', 1);
    }

}
