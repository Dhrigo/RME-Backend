<?php

namespace Modules\LayananOxygenUsage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananOxygenUsage\Models\OxygenUsage;
use Tests\TestCase;

class OxygenUsageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_oxygen_usages(): void
    {
        $this->actingUser();
        OxygenUsage::factory()->count(3)->create();

        $this->getJson('/api/v1/oxygen-usages')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_oxygen_usage(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/oxygen-usages', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'flow_rate_lpm' => 12.5,
            'method' => 'Test Method',
            'started_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('oxygen_usages', 1);
    }

    public function test_it_shows_oxygen_usage(): void
    {
        $this->actingUser();
        $oxygen_usage = OxygenUsage::factory()->create();

        $this->getJson("/api/v1/oxygen-usages/{$oxygen_usage->id}")->assertOk()->assertJsonPath('data.id', $oxygen_usage->id);
    }

}
