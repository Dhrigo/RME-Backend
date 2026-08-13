<?php

namespace Modules\InventoryItemSerialNumber\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItemSerialNumber\Models\ItemSerialNumber;
use Modules\InventoryWardItemStock\Models\WardItemStock;
use Tests\TestCase;

class InventoryItemSerialNumberControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_item_serial_numbers(): void
    {
        $this->actingUser();
        ItemSerialNumber::factory()->count(3)->create();

        $this->getJson('/api/v1/inventoryitemserialnumbers')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item_serial_number(): void
    {
        $this->actingUser();
        $stock = WardItemStock::factory()->create();

        $response = $this->postJson('/api/v1/inventoryitemserialnumbers', [
            'ward_item_stock_id' => $stock->id,
            'serial_number' => 'SN-00012345',
            'expiry_date' => '2027-01-01',
        ]);

        $response->assertCreated()->assertJsonPath('data.serial_number', 'SN-00012345');
        $this->assertDatabaseHas('item_serial_numbers', ['serial_number' => 'SN-00012345']);
    }

    public function test_it_rejects_duplicate_serial_number(): void
    {
        $this->actingUser();
        $stock = WardItemStock::factory()->create();
        ItemSerialNumber::factory()->create(['ward_item_stock_id' => $stock->id, 'serial_number' => 'SN-DUP']);

        $this->postJson('/api/v1/inventoryitemserialnumbers', [
            'ward_item_stock_id' => $stock->id,
            'serial_number' => 'SN-DUP',
        ])->assertStatus(422);
    }

    public function test_it_updates_expiry_date(): void
    {
        $this->actingUser();
        $serial = ItemSerialNumber::factory()->create();

        $this->putJson("/api/v1/inventoryitemserialnumbers/{$serial->id}", ['expiry_date' => '2028-05-01'])
            ->assertOk()
            ->assertJsonPath('data.expiry_date', '2028-05-01');
    }

    public function test_it_deletes_item_serial_number(): void
    {
        $this->actingUser();
        $serial = ItemSerialNumber::factory()->create();

        $this->deleteJson("/api/v1/inventoryitemserialnumbers/{$serial->id}")->assertStatus(204);
        $this->assertDatabaseMissing('item_serial_numbers', ['id' => $serial->id]);
    }

    public function test_guest_cannot_access_item_serial_numbers(): void
    {
        $this->getJson('/api/v1/inventoryitemserialnumbers')->assertStatus(401);
    }
}
