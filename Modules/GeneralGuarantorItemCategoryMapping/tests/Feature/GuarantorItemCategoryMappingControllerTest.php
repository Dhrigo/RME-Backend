<?php

namespace Modules\GeneralGuarantorItemCategoryMapping\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralGuarantorItemCategoryMapping\Models\GuarantorItemCategoryMapping;
use Modules\InventoryItemCategory\Models\ItemCategory;
use Modules\PendaftaranGuarantor\Models\Guarantor;
use Tests\TestCase;

class GuarantorItemCategoryMappingControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_mappings(): void
    {
        $this->actingUser();
        GuarantorItemCategoryMapping::factory()->count(3)->create();

        $this->getJson('/api/v1/guarantor-item-category-mappings')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_mapping(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();
        $category = ItemCategory::factory()->create();

        $this->postJson('/api/v1/guarantor-item-category-mappings', [
            'guarantor_id' => $guarantor->id,
            'item_category_id' => $category->id,
            'coverage_percentage' => 80,
        ])->assertCreated()->assertJsonPath('data.coverage_percentage', '80.00');

        $this->assertDatabaseHas('guarantor_item_category_mappings', ['guarantor_id' => $guarantor->id, 'item_category_id' => $category->id]);
    }

    public function test_it_rejects_unknown_item_category(): void
    {
        $this->actingUser();
        $guarantor = Guarantor::factory()->create();

        $this->postJson('/api/v1/guarantor-item-category-mappings', [
            'guarantor_id' => $guarantor->id,
            'item_category_id' => 99999,
        ])->assertStatus(422);
    }

    public function test_it_updates_mapping(): void
    {
        $this->actingUser();
        $mapping = GuarantorItemCategoryMapping::factory()->create(['is_covered' => true]);

        $this->putJson("/api/v1/guarantor-item-category-mappings/{$mapping->id}", ['is_covered' => false])
            ->assertOk()
            ->assertJsonPath('data.is_covered', false);
    }

    public function test_it_deletes_mapping(): void
    {
        $this->actingUser();
        $mapping = GuarantorItemCategoryMapping::factory()->create();

        $this->deleteJson("/api/v1/guarantor-item-category-mappings/{$mapping->id}")->assertStatus(204);
        $this->assertDatabaseMissing('guarantor_item_category_mappings', ['id' => $mapping->id]);
    }
}
