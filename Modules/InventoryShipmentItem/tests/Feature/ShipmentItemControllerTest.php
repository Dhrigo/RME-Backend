<?php

namespace Modules\InventoryShipmentItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryShipment\Models\Shipment;
use Modules\InventoryShipmentItem\Models\ShipmentItem;
use Tests\TestCase;

class ShipmentItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_shipment_item(): void
    {
        $this->actingUser();
        $shipment = Shipment::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/shipment-items', [
            'shipment_id' => $shipment->id,
            'item_id' => $item->id,
            'quantity' => 7,
        ]);

        $response->assertCreated()->assertJsonPath('data.quantity', 7);
        $this->assertDatabaseHas('shipment_items', ['shipment_id' => $shipment->id, 'item_id' => $item->id]);
    }

    public function test_it_lists_items_filtered_by_shipment(): void
    {
        $this->actingUser();
        $shipment = Shipment::factory()->create();
        ShipmentItem::factory()->create(['shipment_id' => $shipment->id]);
        ShipmentItem::factory()->create(['shipment_id' => $shipment->id]);
        ShipmentItem::factory()->create();

        $response = $this->getJson("/api/v1/shipment-items?shipment_id={$shipment->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_shipment_item(): void
    {
        $this->actingUser();
        $item = ShipmentItem::factory()->create();

        $this->getJson("/api/v1/shipment-items/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_store_requires_shipment_and_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/shipment-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['shipment_id', 'item_id', 'quantity']);
    }

    public function test_guest_cannot_access_shipment_items(): void
    {
        $this->getJson('/api/v1/shipment-items')->assertStatus(401);
    }
}
