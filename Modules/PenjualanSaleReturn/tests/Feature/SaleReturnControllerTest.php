<?php

namespace Modules\PenjualanSaleReturn\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PenjualanSale\Models\Sale;
use Modules\PenjualanSaleReturn\Models\SaleReturn;
use Tests\TestCase;

class SaleReturnControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_sale_return(): void
    {
        $this->actingUser();
        $sale = Sale::factory()->create();

        $response = $this->postJson('/api/v1/sale-returns', [
            'sale_id' => $sale->id,
            'reason' => 'Barang rusak',
            'refund_amount' => 25000,
        ]);

        $response->assertCreated();
        $response->assertJsonPath('data.sale_id', $sale->id);
        $response->assertJsonPath('data.refund_amount', '25000.00');
    }

    public function test_it_lists_returns_filtered_by_sale(): void
    {
        $this->actingUser();
        $sale = Sale::factory()->create();
        SaleReturn::factory()->count(2)->create(['sale_id' => $sale->id]);
        SaleReturn::factory()->create();

        $response = $this->getJson("/api/v1/sale-returns?sale_id={$sale->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_has_no_update_or_delete_route(): void
    {
        $this->actingUser();
        $return = SaleReturn::factory()->create();

        $this->putJson("/api/v1/sale-returns/{$return->id}", ['refund_amount' => 1])->assertStatus(405);
        $this->deleteJson("/api/v1/sale-returns/{$return->id}")->assertStatus(405);
    }

    public function test_guest_cannot_access_sale_returns(): void
    {
        $this->getJson('/api/v1/sale-returns')->assertStatus(401);
    }
}
