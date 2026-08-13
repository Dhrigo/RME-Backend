<?php

namespace Modules\InventoryReceivingItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryReceivingItem\Models\ReceivingItem;
use Modules\InventoryReceivingRecord\Models\ReceivingRecord;
use Tests\TestCase;

class ReceivingItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_receiving_item(): void
    {
        $this->actingUser();
        $record = ReceivingRecord::factory()->create();
        $item = Item::factory()->create();

        $response = $this->postJson('/api/v1/receiving-items', [
            'receiving_record_id' => $record->id,
            'item_id' => $item->id,
            'quantity' => 10,
            'unit_price' => 15000,
        ]);

        $response->assertCreated()->assertJsonPath('data.quantity', 10);
        $this->assertDatabaseHas('receiving_items', ['receiving_record_id' => $record->id, 'item_id' => $item->id]);
    }

    public function test_it_lists_items_filtered_by_receiving_record(): void
    {
        $this->actingUser();
        $record = ReceivingRecord::factory()->create();
        ReceivingItem::factory()->create(['receiving_record_id' => $record->id]);
        ReceivingItem::factory()->create(['receiving_record_id' => $record->id]);
        ReceivingItem::factory()->create();

        $response = $this->getJson("/api/v1/receiving-items?receiving_record_id={$record->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_receiving_item(): void
    {
        $this->actingUser();
        $item = ReceivingItem::factory()->create();

        $this->getJson("/api/v1/receiving-items/{$item->id}")
            ->assertOk()
            ->assertJsonPath('data.id', $item->id);
    }

    public function test_store_requires_record_and_item(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/receiving-items', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['receiving_record_id', 'item_id', 'quantity']);
    }

    public function test_guest_cannot_access_receiving_items(): void
    {
        $this->getJson('/api/v1/receiving-items')->assertStatus(401);
    }
}
