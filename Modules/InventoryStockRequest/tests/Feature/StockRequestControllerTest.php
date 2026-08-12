<?php

namespace Modules\InventoryStockRequest\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Models\StockRequest;
use Tests\TestCase;

class StockRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pending_request(): void
    {
        $user = $this->actingUser();
        $ward = Ward::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/stock-requests', [
            'ward_id' => $ward->id,
            'item_id' => $item->id,
            'quantity' => 5,
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseHas('stock_requests', ['ward_id' => $ward->id, 'requested_by' => $user->id]);
    }

    public function test_it_fulfills_a_request_and_decrements_stock(): void
    {
        $this->actingUser();
        $item = Item::factory()->create(['stock_quantity' => 20]);
        $stockRequest = StockRequest::factory()->create(['item_id' => $item->id, 'quantity' => 15]);

        $response = $this->putJson("/api/v1/stock-requests/{$stockRequest->id}", ['status' => 'fulfilled']);

        $response->assertOk()->assertJsonPath('data.status', 'fulfilled');
        $this->assertEquals(5, $item->fresh()->stock_quantity);
    }

    public function test_it_rejects_fulfilling_when_stock_insufficient(): void
    {
        $this->actingUser();
        $item = Item::factory()->create(['stock_quantity' => 3]);
        $stockRequest = StockRequest::factory()->create(['item_id' => $item->id, 'quantity' => 15]);

        $this->putJson("/api/v1/stock-requests/{$stockRequest->id}", ['status' => 'fulfilled'])
            ->assertStatus(422);
        $this->assertEquals(3, $item->fresh()->stock_quantity);
    }

    public function test_it_rejects_a_request_without_touching_stock(): void
    {
        $this->actingUser();
        $item = Item::factory()->create(['stock_quantity' => 20]);
        $stockRequest = StockRequest::factory()->create(['item_id' => $item->id, 'quantity' => 5]);

        $this->putJson("/api/v1/stock-requests/{$stockRequest->id}", ['status' => 'rejected'])
            ->assertOk()
            ->assertJsonPath('data.status', 'rejected');
        $this->assertEquals(20, $item->fresh()->stock_quantity);
    }

    public function test_guest_cannot_access_stock_requests(): void
    {
        $this->getJson('/api/v1/stock-requests')->assertStatus(401);
    }
}
