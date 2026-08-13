<?php

namespace Modules\InventoryWardStockTransaction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardItemStock\Models\WardItemStock;
use Tests\TestCase;

class WardStockTransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_an_in_transaction_and_increments_ward_stock(): void
    {
        $user = $this->actingUser();
        $ward = Ward::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/ward-stock-transactions', [
            'ward_id' => $ward->id,
            'item_id' => $item->id,
            'type' => 'in',
            'quantity' => 20,
        ]);

        $response->assertCreated()->assertJsonPath('data.type', 'in');
        $this->assertDatabaseHas('ward_stock_transactions', ['ward_id' => $ward->id, 'performed_by' => $user->id]);
        $this->assertEquals(20, WardItemStock::where('ward_id', $ward->id)->where('item_id', $item->id)->value('quantity'));
    }

    public function test_it_records_an_out_transaction_and_decrements_ward_stock(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $item = Item::factory()->create();
        WardItemStock::create(['ward_id' => $ward->id, 'item_id' => $item->id, 'quantity' => 30]);

        $this->postJson('/api/v1/ward-stock-transactions', [
            'ward_id' => $ward->id,
            'item_id' => $item->id,
            'type' => 'out',
            'quantity' => 12,
        ])->assertCreated();

        $this->assertEquals(18, WardItemStock::where('ward_id', $ward->id)->where('item_id', $item->id)->value('quantity'));
    }

    public function test_it_rejects_an_out_transaction_when_stock_is_insufficient(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $item = Item::factory()->create();
        WardItemStock::create(['ward_id' => $ward->id, 'item_id' => $item->id, 'quantity' => 5]);

        $this->postJson('/api/v1/ward-stock-transactions', [
            'ward_id' => $ward->id,
            'item_id' => $item->id,
            'type' => 'out',
            'quantity' => 10,
        ])->assertStatus(422);

        $this->assertEquals(5, WardItemStock::where('ward_id', $ward->id)->where('item_id', $item->id)->value('quantity'));
    }

    public function test_it_lists_transactions_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        $item = Item::factory()->create();
        $this->postJson('/api/v1/ward-stock-transactions', [
            'ward_id' => $ward->id, 'item_id' => $item->id, 'type' => 'in', 'quantity' => 5,
        ])->assertCreated();
        $this->postJson('/api/v1/ward-stock-transactions', [
            'ward_id' => Ward::factory()->create()->id, 'item_id' => $item->id, 'type' => 'in', 'quantity' => 5,
        ])->assertCreated();

        $response = $this->getJson("/api/v1/ward-stock-transactions?ward_id={$ward->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_guest_cannot_access_ward_stock_transactions(): void
    {
        $this->getJson('/api/v1/ward-stock-transactions')->assertStatus(401);
    }
}
