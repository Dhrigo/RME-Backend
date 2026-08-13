<?php

namespace Modules\InventoryItemCategory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItemCategory\Models\ItemCategory;
use Tests\TestCase;

class InventoryItemCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_item_categories(): void
    {
        $this->actingUser();
        ItemCategory::factory()->count(3)->create();

        $this->getJson('/api/v1/inventoryitemcategories')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item_category(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/inventoryitemcategories', ['name' => 'Obat', 'code' => 'OBT'])
            ->assertCreated()
            ->assertJsonPath('name', 'Obat');

        $this->assertDatabaseHas('item_categories', ['name' => 'Obat']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        ItemCategory::factory()->create(['name' => 'Obat']);

        $this->postJson('/api/v1/inventoryitemcategories', ['name' => 'Obat'])->assertStatus(422);
    }

    public function test_it_updates_item_category(): void
    {
        $this->actingUser();
        $category = ItemCategory::factory()->create();

        $this->putJson("/api/v1/inventoryitemcategories/{$category->id}", ['name' => 'Alkes'])
            ->assertOk()
            ->assertJsonPath('name', 'Alkes');
    }

    public function test_it_deletes_item_category(): void
    {
        $this->actingUser();
        $category = ItemCategory::factory()->create();

        $this->deleteJson("/api/v1/inventoryitemcategories/{$category->id}")->assertStatus(204);
        $this->assertDatabaseMissing('item_categories', ['id' => $category->id]);
    }

    public function test_guest_cannot_access_item_categories(): void
    {
        $this->getJson('/api/v1/inventoryitemcategories')->assertStatus(401);
    }
}
