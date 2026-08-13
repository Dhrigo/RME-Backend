<?php

namespace Modules\PenjualanSaleItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\PenjualanSale\Models\Sale;
use Modules\PenjualanSaleItem\Models\SaleItem;
use Tests\TestCase;

class SaleItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_sale_item(): void
    {
        $this->actingUser();
        $sale = Sale::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/sale-items', [
            'sale_id' => $sale->id,
            'item_id' => $item->id,
            'quantity' => 3,
            'unit_price' => 10000,
            'subtotal' => 30000,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.quantity', 3);
        $response->assertJsonPath('data.subtotal', '30000.00');
    }

    public function test_it_lists_items_filtered_by_sale(): void
    {
        $this->actingUser();
        $sale = Sale::factory()->create();
        SaleItem::factory()->count(2)->create(['sale_id' => $sale->id]);
        SaleItem::factory()->create();

        $response = $this->getJson("/api/v1/sale-items?sale_id={$sale->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_has_no_update_or_delete_route(): void
    {
        $this->actingUser();
        $item = SaleItem::factory()->create();

        $this->putJson("/api/v1/sale-items/{$item->id}", ['quantity' => 9])->assertStatus(405);
        $this->deleteJson("/api/v1/sale-items/{$item->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_sale_items(): void
    {
        $this->getJson('/api/v1/sale-items')->assertStatus(401);
    }
}
