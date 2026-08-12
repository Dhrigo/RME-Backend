<?php

namespace Modules\InventorySupplier\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventorySupplier\Models\Supplier;
use Tests\TestCase;

class SupplierControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_a_supplier(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/suppliers', [
            'name' => 'PT Kimia Farma',
            'phone' => '021-1234567',
        ]);

        $response->assertCreated()->assertJsonPath('data.name', 'PT Kimia Farma');
    }

    public function test_it_lists_suppliers_filtered_by_name(): void
    {
        $this->actingUser();
        Supplier::factory()->create(['name' => 'Kimia Farma']);
        Supplier::factory()->create(['name' => 'Kalbe Farma']);

        $response = $this->getJson('/api/v1/suppliers?name=Kimia');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_updates_a_supplier(): void
    {
        $this->actingUser();
        $supplier = Supplier::factory()->create();

        $response = $this->putJson("/api/v1/suppliers/{$supplier->id}", ['is_active' => false]);

        $response->assertOk()->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_a_supplier(): void
    {
        $this->actingUser();
        $supplier = Supplier::factory()->create();

        $this->deleteJson("/api/v1/suppliers/{$supplier->id}")->assertNoContent();
        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);
    }

    public function test_guest_cannot_access_suppliers(): void
    {
        $this->getJson('/api/v1/suppliers')->assertStatus(401);
    }
}
