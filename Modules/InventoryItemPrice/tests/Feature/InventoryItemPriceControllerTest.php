<?php

namespace Modules\InventoryItemPrice\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryItemPrice\Models\ItemPrice;
use Tests\TestCase;

class InventoryItemPriceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_item_prices(): void
    {
        $this->actingUser();
        ItemPrice::factory()->count(3)->create();

        $this->getJson('/api/v1/inventoryitemprices')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item_price_and_deactivates_previous_active_price(): void
    {
        $this->actingUser();
        $item = Item::factory()->create();
        $oldPrice = ItemPrice::factory()->create(['item_id' => $item->id, 'is_active' => true]);

        $response = $this->postJson('/api/v1/inventoryitemprices', [
            'item_id' => $item->id,
            'price' => 15000,
            'effective_date' => now()->toDateString(),
        ]);

        $response->assertCreated()->assertJsonPath('data.is_active', true);
        $this->assertFalse($oldPrice->fresh()->is_active);
    }

    public function test_it_rejects_missing_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/inventoryitemprices', ['price' => 1000, 'effective_date' => now()->toDateString()])
            ->assertStatus(422);
    }

    public function test_it_updates_is_active(): void
    {
        $this->actingUser();
        $price = ItemPrice::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/inventoryitemprices/{$price->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_guest_cannot_access_item_prices(): void
    {
        $this->getJson('/api/v1/inventoryitemprices')->assertStatus(401);
    }
}
