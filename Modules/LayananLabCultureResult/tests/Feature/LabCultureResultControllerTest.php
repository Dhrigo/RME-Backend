<?php

namespace Modules\LayananLabCultureResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananLabCultureResult\Models\LabCultureResult;
use Tests\TestCase;

class LabCultureResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_culture_results(): void
    {
        $this->actingUser();
        LabCultureResult::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-culture-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_culture_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-culture-results', [
            'lab_order_id' => \Modules\LayananLabOrder\Models\LabOrder::factory()->create()->id,
            'specimen_type' => 'Test Specimen_type',
            'examined_at' => '2026-01-01 08:00:00',
            'result_status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('lab_culture_results', 1);
    }

    public function test_it_shows_culture_result(): void
    {
        $this->actingUser();
        $culture_result = LabCultureResult::factory()->create();

        $this->getJson("/api/v1/lab-culture-results/{$culture_result->id}")->assertOk()->assertJsonPath('data.id', $culture_result->id);
    }

}
