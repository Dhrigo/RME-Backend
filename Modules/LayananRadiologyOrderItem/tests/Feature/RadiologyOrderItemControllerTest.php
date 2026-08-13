<?php

namespace Modules\LayananRadiologyOrderItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananRadiologyOrderItem\Models\RadiologyOrderItem;
use Tests\TestCase;

class RadiologyOrderItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_rad_order_items(): void
    {
        $this->actingUser();
        RadiologyOrderItem::factory()->count(3)->create();

        $this->getJson('/api/v1/radiology-order-items')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_rad_order_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/radiology-order-items', [
            'radiology_order_id' => \Modules\LayananRadiologyOrder\Models\RadiologyOrder::factory()->create()->id,
            'examination_name' => 'Test Examination_name',
        ])->assertCreated();

        $this->assertDatabaseCount('radiology_order_items', 1);
    }

}
