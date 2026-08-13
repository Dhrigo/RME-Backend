<?php

namespace Modules\LayananRadiologyOrder\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;
use Tests\TestCase;

class RadiologyOrderControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_rad_orders(): void
    {
        $this->actingUser();
        RadiologyOrder::factory()->count(3)->create();

        $this->getJson('/api/v1/radiology-orders')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_rad_order(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/radiology-orders', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'ordered_at' => '2026-01-01 08:00:00',
            'status' => 'pending',
        ])->assertCreated();

        $this->assertDatabaseCount('radiology_orders', 1);
    }

    public function test_it_shows_rad_order(): void
    {
        $this->actingUser();
        $rad_order = RadiologyOrder::factory()->create();

        $this->getJson("/api/v1/radiology-orders/{$rad_order->id}")->assertOk()->assertJsonPath('data.id', $rad_order->id);
    }

}
