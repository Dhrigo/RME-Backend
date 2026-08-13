<?php

namespace Modules\InventoryGoodsReturn\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReturn\Models\GoodsReturn;
use Modules\InventorySupplier\Models\Supplier;
use Tests\TestCase;

class GoodsReturnControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pending_return(): void
    {
        $user = $this->actingUser();
        $supplier = Supplier::factory()->create();

        $response = $this->postJson('/api/v1/goods-returns', [
            'supplier_id' => $supplier->id,
            'reason' => 'Barang rusak saat pengiriman',
        ]);

        $response->assertCreated()->assertJsonPath('data.status', 'pending');
        $this->assertDatabaseHas('goods_returns', ['supplier_id' => $supplier->id, 'returned_by' => $user->id]);
    }

    public function test_it_lists_returns_filtered_by_status(): void
    {
        $this->actingUser();
        GoodsReturn::factory()->create(['status' => 'pending']);
        GoodsReturn::factory()->create(['status' => 'completed']);

        $response = $this->getJson('/api/v1/goods-returns?status=completed');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_updates_status_to_approved(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create(['status' => 'pending']);

        $response = $this->putJson("/api/v1/goods-returns/{$return->id}", ['status' => 'approved']);

        $response->assertOk()->assertJsonPath('data.status', 'approved');
    }

    public function test_it_rejects_invalid_status(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create();

        $this->putJson("/api/v1/goods-returns/{$return->id}", ['status' => 'not-a-real-status'])
            ->assertStatus(422);
    }

    public function test_it_deletes_a_return(): void
    {
        $this->actingUser();
        $return = GoodsReturn::factory()->create();

        $this->deleteJson("/api/v1/goods-returns/{$return->id}")->assertNoContent();
        $this->assertDatabaseMissing('goods_returns', ['id' => $return->id]);
    }

    public function test_guest_cannot_access_goods_returns(): void
    {
        $this->getJson('/api/v1/goods-returns')->assertStatus(401);
    }
}
