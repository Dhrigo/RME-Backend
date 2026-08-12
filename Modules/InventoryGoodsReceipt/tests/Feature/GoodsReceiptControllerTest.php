<?php

namespace Modules\InventoryGoodsReceipt\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryItem\Models\Item;
use Modules\InventorySupplier\Models\Supplier;
use Tests\TestCase;

class GoodsReceiptControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_receipt_and_increments_item_stock(): void
    {
        $user = $this->actingUser();
        $supplier = Supplier::factory()->create();
        $item = Item::factory()->create(['stock_quantity' => 10]);

        $response = $this->postJson('/api/v1/goods-receipts', [
            'supplier_id' => $supplier->id,
            'item_id' => $item->id,
            'quantity' => 50,
        ]);

        $response->assertCreated();
        $this->assertStringStartsWith('REC-'.now()->format('Y').'-', $response->json('data.receipt_number'));
        $this->assertDatabaseHas('goods_receipts', ['item_id' => $item->id, 'received_by' => $user->id]);
        $this->assertEquals(60, $item->fresh()->stock_quantity);
    }

    public function test_it_lists_receipts_filtered_by_item(): void
    {
        $this->actingUser();
        $item = Item::factory()->create();
        GoodsReceipt::factory()->count(2)->create(['item_id' => $item->id]);
        GoodsReceipt::factory()->create();

        $response = $this->getJson("/api/v1/goods-receipts?item_id={$item->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_guest_cannot_access_goods_receipts(): void
    {
        $this->getJson('/api/v1/goods-receipts')->assertStatus(401);
    }
}
