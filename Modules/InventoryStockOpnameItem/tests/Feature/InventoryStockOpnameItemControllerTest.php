<?php

namespace Modules\InventoryStockOpnameItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockOpname\Models\StockOpname;
use Modules\InventoryStockOpnameItem\Models\StockOpnameItem;
use Tests\TestCase;

class InventoryStockOpnameItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_stock_opname_items(): void
    {
        $this->actingUser();
        StockOpnameItem::factory()->count(3)->create();

        $this->getJson('/api/v1/inventorystockopnameitems')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_stock_opname_item_and_computes_difference(): void
    {
        $this->actingUser();
        $opname = StockOpname::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/inventorystockopnameitems', [
            'stock_opname_id' => $opname->id,
            'item_id' => $item->id,
            'system_quantity' => 100,
            'physical_quantity' => 92,
        ]);

        $response->assertCreated()->assertJsonPath('data.difference', -8);
        $this->assertDatabaseHas('stock_opname_items', ['stock_opname_id' => $opname->id, 'item_id' => $item->id, 'difference' => -8]);
    }

    public function test_it_rejects_missing_physical_quantity(): void
    {
        $this->actingUser();
        $opname = StockOpname::factory()->create();
        $item = Item::factory()->create();

        $this->postJson('/api/v1/inventorystockopnameitems', [
            'stock_opname_id' => $opname->id,
            'item_id' => $item->id,
            'system_quantity' => 100,
        ])->assertStatus(422);
    }

    public function test_it_shows_a_stock_opname_item(): void
    {
        $this->actingUser();
        $item = StockOpnameItem::factory()->create();

        $this->getJson("/api/v1/inventorystockopnameitems/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_no_update_or_destroy_routes_exist(): void
    {
        $this->actingUser();
        $item = StockOpnameItem::factory()->create();

        $this->putJson("/api/v1/inventorystockopnameitems/{$item->id}", ['system_quantity' => 1])->assertStatus(405);
        $this->deleteJson("/api/v1/inventorystockopnameitems/{$item->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_stock_opname_items(): void
    {
        $this->getJson('/api/v1/inventorystockopnameitems')->assertStatus(401);
    }
}
