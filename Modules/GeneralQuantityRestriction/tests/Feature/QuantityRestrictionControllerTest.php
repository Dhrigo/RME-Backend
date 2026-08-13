<?php

namespace Modules\GeneralQuantityRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralQuantityRestriction\Models\QuantityRestriction;
use Tests\TestCase;

class QuantityRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_restrictions(): void
    {
        $this->actingUser();
        QuantityRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/quantity-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_restriction(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/quantity-restrictions', [
            'drug_name' => 'Meropenem',
            'max_quantity_per_prescription' => 20,
            'unit' => 'vial',
        ])->assertCreated()->assertJsonPath('data.max_quantity_per_prescription', 20);

        $this->assertDatabaseHas('quantity_restrictions', ['drug_name' => 'Meropenem', 'unit' => 'vial']);
    }

    public function test_it_rejects_duplicate_drug(): void
    {
        $this->actingUser();
        QuantityRestriction::factory()->create(['drug_name' => 'Vancomycin']);

        $this->postJson('/api/v1/quantity-restrictions', [
            'drug_name' => 'Vancomycin',
            'max_quantity_per_prescription' => 10,
            'unit' => 'vial',
        ])->assertStatus(422);
    }

    public function test_it_updates_restriction(): void
    {
        $this->actingUser();
        $restriction = QuantityRestriction::factory()->create(['max_quantity_per_prescription' => 20]);

        $this->putJson("/api/v1/quantity-restrictions/{$restriction->id}", ['max_quantity_per_prescription' => 15])
            ->assertOk()
            ->assertJsonPath('data.max_quantity_per_prescription', 15);
    }

    public function test_it_deletes_restriction(): void
    {
        $this->actingUser();
        $restriction = QuantityRestriction::factory()->create();

        $this->deleteJson("/api/v1/quantity-restrictions/{$restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('quantity_restrictions', ['id' => $restriction->id]);
    }
}
