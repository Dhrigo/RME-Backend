<?php

namespace Modules\InventoryGoodsReturnItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;
use Modules\InventoryGoodsReturnItem\Models\GoodsReturnItem;
use Modules\InventoryItem\Models\Item;
use Tests\TestCase;

class GoodsReturnItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_adds_a_line_item_to_a_return(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/goods-return-items', [
            'goods_return_id' => $return->id,
            'item_id' => $item->id,
            'quantity' => 5,
            'reason' => 'Rusak',
        ]);

        $response->assertCreated()->assertJsonPath('data.quantity', 5);
        $this->assertDatabaseHas('goods_return_items', ['goods_return_id' => $return->id, 'item_id' => $item->id]);
    }

    public function test_it_requires_a_positive_quantity(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create();
        $item = Item::factory()->create();

        $this->postJson('/api/v1/goods-return-items', [
            'goods_return_id' => $return->id,
            'item_id' => $item->id,
            'quantity' => 0,
        ])->assertStatus(422);
    }

    public function test_it_lists_items_filtered_by_return(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create();
        GoodsReturnItem::factory()->create(['goods_return_id' => $return->id]);
        GoodsReturnItem::factory()->create();

        $response = $this->getJson("/api/v1/goods-return-items?goods_return_id={$return->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_deleting_the_return_cascades_to_its_items(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create();
        $item = GoodsReturnItem::factory()->create(['goods_return_id' => $return->id]);

        $return->delete();

        $this->assertDatabaseMissing('goods_return_items', ['id' => $item->id]);
    }

    public function test_guest_cannot_access_goods_return_items(): void
    {
        $this->getJson('/api/v1/goods-return-items')->assertStatus(401);
    }
}
