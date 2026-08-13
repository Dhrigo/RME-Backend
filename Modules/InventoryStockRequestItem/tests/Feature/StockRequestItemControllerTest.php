<?php

namespace Modules\InventoryStockRequestItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Models\StockRequest;
use Modules\InventoryStockRequestItem\Models\StockRequestItem;
use Tests\TestCase;

class StockRequestItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_adds_a_line_item_to_a_request(): void
    {
        $this->actingUser();
        $request = StockRequest::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/stock-request-items', [
            'stock_request_id' => $request->id,
            'item_id' => $item->id,
            'quantity' => 10,
        ]);

        $response->assertCreated()->assertJsonPath('data.quantity', 10);
        $this->assertDatabaseHas('stock_request_items', ['stock_request_id' => $request->id, 'item_id' => $item->id]);
    }

    public function test_it_requires_a_positive_quantity(): void
    {
        $this->actingUser();
        $request = StockRequest::factory()->create();
        $item = Item::factory()->create();

        $this->postJson('/api/v1/stock-request-items', [
            'stock_request_id' => $request->id,
            'item_id' => $item->id,
            'quantity' => 0,
        ])->assertStatus(422);
    }

    public function test_it_lists_items_filtered_by_request(): void
    {
        $this->actingUser();
        $stockRequest = StockRequest::factory()->create();
        StockRequestItem::factory()->create(['stock_request_id' => $stockRequest->id]);
        StockRequestItem::factory()->create();

        $response = $this->getJson("/api/v1/stock-request-items?stock_request_id={$stockRequest->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_deleting_the_request_cascades_to_its_items(): void
    {
        $this->actingUser();
        $stockRequest = StockRequest::factory()->create();
        $item = StockRequestItem::factory()->create(['stock_request_id' => $stockRequest->id]);

        $stockRequest->delete();

        $this->assertDatabaseMissing('stock_request_items', ['id' => $item->id]);
    }

    public function test_guest_cannot_access_stock_request_items(): void
    {
        $this->getJson('/api/v1/stock-request-items')->assertStatus(401);
    }
}
