<?php

namespace Modules\LayananMedicalSupplyUsageItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananMedicalSupplyUsageItem\Models\MedicalSupplyUsageItem;
use Tests\TestCase;

class MedicalSupplyUsageItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_supply_usage_items(): void
    {
        $this->actingUser();
        MedicalSupplyUsageItem::factory()->count(3)->create();

        $this->getJson('/api/v1/medical-supply-usage-items')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_supply_usage_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/medical-supply-usage-items', [
            'medical_supply_usage_id' => \Modules\LayananMedicalSupplyUsage\Models\MedicalSupplyUsage::factory()->create()->id,
            'item_id' => \Modules\InventoryItem\Models\Item::factory()->create()->id,
            'quantity' => 5,
        ])->assertCreated();

        $this->assertDatabaseCount('medical_supply_usage_items', 1);
    }

}
