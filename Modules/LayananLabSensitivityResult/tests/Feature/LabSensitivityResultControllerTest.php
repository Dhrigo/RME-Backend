<?php

namespace Modules\LayananLabSensitivityResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabSensitivityResult\Models\LabSensitivityResult;
use Tests\TestCase;

class LabSensitivityResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_sensitivity_results(): void
    {
        $this->actingUser();
        LabSensitivityResult::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-sensitivity-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_sensitivity_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-sensitivity-results', [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory()->create()->id,
            'organism' => 'Test Organism',
            'antibiotic_name' => 'Test Antibiotic_name',
            'sensitivity_result' => 'sensitive',
            'examined_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_sensitivity_results', 1);
    }

}
