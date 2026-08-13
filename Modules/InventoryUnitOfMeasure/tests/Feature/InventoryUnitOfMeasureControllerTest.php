<?php

namespace Modules\InventoryUnitOfMeasure\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryUnitOfMeasure\Models\UnitOfMeasure;
use Tests\TestCase;

class InventoryUnitOfMeasureControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_unit_of_measures(): void
    {
        $this->actingUser();
        UnitOfMeasure::factory()->count(3)->create();

        $this->getJson('/api/v1/inventoryunitofmeasures')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_unit_of_measure(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/inventoryunitofmeasures', ['name' => 'Botol', 'code' => 'BTL', 'abbreviation' => 'btl'])
            ->assertCreated()
            ->assertJsonPath('name', 'Botol')
            ->assertJsonPath('abbreviation', 'btl');

        $this->assertDatabaseHas('unit_of_measures', ['name' => 'Botol']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        UnitOfMeasure::factory()->create(['name' => 'Botol']);

        $this->postJson('/api/v1/inventoryunitofmeasures', ['name' => 'Botol'])->assertStatus(422);
    }

    public function test_it_updates_unit_of_measure(): void
    {
        $this->actingUser();
        $uom = UnitOfMeasure::factory()->create();

        $this->putJson("/api/v1/inventoryunitofmeasures/{$uom->id}", ['abbreviation' => 'tab'])
            ->assertOk()
            ->assertJsonPath('abbreviation', 'tab');
    }

    public function test_it_deletes_unit_of_measure(): void
    {
        $this->actingUser();
        $uom = UnitOfMeasure::factory()->create();

        $this->deleteJson("/api/v1/inventoryunitofmeasures/{$uom->id}")->assertStatus(204);
        $this->assertDatabaseMissing('unit_of_measures', ['id' => $uom->id]);
    }

    public function test_guest_cannot_access_unit_of_measures(): void
    {
        $this->getJson('/api/v1/inventoryunitofmeasures')->assertStatus(401);
    }
}
