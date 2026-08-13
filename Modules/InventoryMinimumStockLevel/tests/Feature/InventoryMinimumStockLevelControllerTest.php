<?php

namespace Modules\InventoryMinimumStockLevel\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryMinimumStockLevel\Models\MinimumStockLevel;
use Tests\TestCase;

class InventoryMinimumStockLevelControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_minimum_stock_levels(): void
    {
        $this->actingUser();
        MinimumStockLevel::factory()->count(3)->create();

        $this->getJson('/api/v1/inventoryminimumstocklevels')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_minimum_stock_level(): void
    {
        $this->actingUser();
        $item = Item::factory()->create();
        $ward = Ward::factory()->create();

        $response = $this->postJson('/api/v1/inventoryminimumstocklevels', [
            'item_id' => $item->id,
            'ward_id' => $ward->id,
            'minimum_quantity' => 25,
        ]);

        $response->assertCreated()->assertJsonPath('data.minimum_quantity', 25);
        $this->assertDatabaseHas('minimum_stock_levels', ['item_id' => $item->id, 'ward_id' => $ward->id, 'minimum_quantity' => 25]);
    }

    public function test_it_rejects_missing_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/inventoryminimumstocklevels', ['minimum_quantity' => 10])->assertStatus(422);
    }

    public function test_it_updates_minimum_stock_level(): void
    {
        $this->actingUser();
        $level = MinimumStockLevel::factory()->create(['minimum_quantity' => 10]);

        $this->putJson("/api/v1/inventoryminimumstocklevels/{$level->id}", ['minimum_quantity' => 50])
            ->assertOk()
            ->assertJsonPath('data.minimum_quantity', 50);
    }

    public function test_it_deletes_minimum_stock_level(): void
    {
        $this->actingUser();
        $level = MinimumStockLevel::factory()->create();

        $this->deleteJson("/api/v1/inventoryminimumstocklevels/{$level->id}")->assertStatus(204);
        $this->assertDatabaseMissing('minimum_stock_levels', ['id' => $level->id]);
    }

    public function test_guest_cannot_access_minimum_stock_levels(): void
    {
        $this->getJson('/api/v1/inventoryminimumstocklevels')->assertStatus(401);
    }
}
