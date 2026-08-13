<?php

namespace Modules\InventoryItemClassification\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryItemClassification\Models\ItemClassification;
use Tests\TestCase;

class InventoryItemClassificationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_item_classifications(): void
    {
        $this->actingUser();
        ItemClassification::factory()->count(3)->create();

        $this->getJson('/api/v1/inventoryitemclassifications')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_item_classification(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/inventoryitemclassifications', ['name' => 'Alkes Habis Pakai', 'code' => 'AHP'])
            ->assertCreated()
            ->assertJsonPath('name', 'Alkes Habis Pakai');

        $this->assertDatabaseHas('item_classifications', ['name' => 'Alkes Habis Pakai']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        ItemClassification::factory()->create(['name' => 'Obat Generik']);

        $this->postJson('/api/v1/inventoryitemclassifications', ['name' => 'Obat Generik'])->assertStatus(422);
    }

    public function test_it_updates_item_classification(): void
    {
        $this->actingUser();
        $classification = ItemClassification::factory()->create();

        $this->putJson("/api/v1/inventoryitemclassifications/{$classification->id}", ['name' => 'Obat Paten'])
            ->assertOk()
            ->assertJsonPath('name', 'Obat Paten');
    }

    public function test_it_deletes_item_classification(): void
    {
        $this->actingUser();
        $classification = ItemClassification::factory()->create();

        $this->deleteJson("/api/v1/inventoryitemclassifications/{$classification->id}")->assertStatus(204);
        $this->assertDatabaseMissing('item_classifications', ['id' => $classification->id]);
    }

    public function test_guest_cannot_access_item_classifications(): void
    {
        $this->getJson('/api/v1/inventoryitemclassifications')->assertStatus(401);
    }
}
