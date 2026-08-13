<?php

namespace Modules\InventoryWardItemStock\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardItemStock\Models\WardItemStock;
use Tests\TestCase;

class InventoryWardItemStockControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_ward_item_stocks(): void
    {
        $this->actingUser();
        WardItemStock::factory()->count(3)->create();

        $this->getJson('/api/v1/inventorywarditemstocks')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_ward_item_stock(): void
    {
        $this->actingUser();
        $item = Item::factory()->create();
        $ward = Ward::factory()->create();

        $response = $this->postJson('/api/v1/inventorywarditemstocks', [
            'item_id' => $item->id,
            'ward_id' => $ward->id,
            'quantity' => 40,
        ]);

        $response->assertCreated()->assertJsonPath('data.quantity', 40);
        $this->assertDatabaseHas('ward_item_stocks', ['item_id' => $item->id, 'ward_id' => $ward->id, 'quantity' => 40]);
    }

    public function test_it_rejects_missing_ward(): void
    {
        $this->actingUser();
        $item = Item::factory()->create();

        $this->postJson('/api/v1/inventorywarditemstocks', ['item_id' => $item->id, 'quantity' => 5])->assertStatus(422);
    }

    public function test_it_updates_quantity(): void
    {
        $this->actingUser();
        $stock = WardItemStock::factory()->create(['quantity' => 10]);

        $this->putJson("/api/v1/inventorywarditemstocks/{$stock->id}", ['quantity' => 30])
            ->assertOk()
            ->assertJsonPath('data.quantity', 30);
    }

    public function test_it_deletes_ward_item_stock(): void
    {
        $this->actingUser();
        $stock = WardItemStock::factory()->create();

        $this->deleteJson("/api/v1/inventorywarditemstocks/{$stock->id}")->assertStatus(204);
        $this->assertDatabaseMissing('ward_item_stocks', ['id' => $stock->id]);
    }

    public function test_guest_cannot_access_ward_item_stocks(): void
    {
        $this->getJson('/api/v1/inventorywarditemstocks')->assertStatus(401);
    }
}
