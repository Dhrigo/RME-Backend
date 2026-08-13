<?php

namespace Modules\GeneralSalesTax\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralSalesTax\Models\SalesTax;
use Tests\TestCase;

class SalesTaxControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_sales_taxes(): void
    {
        $this->actingUser();
        SalesTax::factory()->count(3)->create();

        $this->getJson('/api/v1/sales-taxes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_sales_tax(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/sales-taxes', ['name' => 'PPN Penjualan Farmasi', 'rate' => 11])
            ->assertCreated()
            ->assertJsonPath('name', 'PPN Penjualan Farmasi');

        $this->assertDatabaseHas('sales_taxes', ['name' => 'PPN Penjualan Farmasi']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        SalesTax::factory()->create(['name' => 'PPN Umum']);

        $this->postJson('/api/v1/sales-taxes', ['name' => 'PPN Umum', 'rate' => 11])->assertStatus(422);
    }

    public function test_it_rejects_rate_over_100(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/sales-taxes', ['name' => 'PPN Salah', 'rate' => 150])->assertStatus(422);
    }

    public function test_it_deletes_sales_tax(): void
    {
        $this->actingUser();
        $tax = SalesTax::factory()->create();

        $this->deleteJson("/api/v1/sales-taxes/{$tax->id}")->assertStatus(204);
        $this->assertDatabaseMissing('sales_taxes', ['id' => $tax->id]);
    }
}
