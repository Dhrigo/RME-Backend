<?php

namespace Modules\LayananRadiologyResult\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananRadiologyResult\Models\RadiologyResult;
use Tests\TestCase;

class RadiologyResultControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_rad_results(): void
    {
        $this->actingUser();
        RadiologyResult::factory()->count(3)->create();

        $this->getJson('/api/v1/radiology-results')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_rad_result(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/radiology-results', [
            'radiology_order_id' => \Modules\LayananRadiologyOrder\Models\RadiologyOrder::factory()->create()->id,
            'findings' => 'Test description text',
            'examined_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('radiology_results', 1);
    }

    public function test_it_shows_rad_result(): void
    {
        $this->actingUser();
        $rad_result = RadiologyResult::factory()->create();

        $this->getJson("/api/v1/radiology-results/{$rad_result->id}")->assertOk()->assertJsonPath('data.id', $rad_result->id);
    }

}
