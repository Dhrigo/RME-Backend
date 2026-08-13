<?php

namespace Modules\InventoryGoodsReceiptCancellation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryGoodsReceiptCancellation\Models\GoodsReceiptCancellation;
use Tests\TestCase;

class GoodsReceiptCancellationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_cancellation_for_a_receipt(): void
    {
        $user = $this->actingUser();
        $receipt = GoodsReceipt::factory()->create();

        $response = $this->postJson('/api/v1/goods-receipt-cancellations', [
            'goods_receipt_id' => $receipt->id,
            'reason' => 'Salah input jumlah barang',
        ]);

        $response->assertCreated()->assertJsonPath('data.goods_receipt_id', $receipt->id);
        $this->assertDatabaseHas('goods_receipt_cancellations', [
            'goods_receipt_id' => $receipt->id,
            'cancelled_by' => $user->id,
        ]);
    }

    public function test_it_requires_a_reason(): void
    {
        $this->actingUser();
        $receipt = GoodsReceipt::factory()->create();

        $this->postJson('/api/v1/goods-receipt-cancellations', ['goods_receipt_id' => $receipt->id])
            ->assertStatus(422);
    }

    public function test_it_lists_cancellations_filtered_by_receipt(): void
    {
        $this->actingUser();
        $receipt = GoodsReceipt::factory()->create();
        GoodsReceiptCancellation::factory()->create(['goods_receipt_id' => $receipt->id]);
        GoodsReceiptCancellation::factory()->create();

        $response = $this->getJson("/api/v1/goods-receipt-cancellations?goods_receipt_id={$receipt->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_deleting_the_receipt_cascades_to_its_cancellation(): void
    {
        $this->actingUser();
        $receipt = GoodsReceipt::factory()->create();
        $cancellation = GoodsReceiptCancellation::factory()->create(['goods_receipt_id' => $receipt->id]);

        $receipt->delete();

        $this->assertDatabaseMissing('goods_receipt_cancellations', ['id' => $cancellation->id]);
    }

    public function test_guest_cannot_access_goods_receipt_cancellations(): void
    {
        $this->getJson('/api/v1/goods-receipt-cancellations')->assertStatus(401);
    }
}
