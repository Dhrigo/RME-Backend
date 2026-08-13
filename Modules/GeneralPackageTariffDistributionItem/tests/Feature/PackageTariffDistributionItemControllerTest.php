<?php

namespace Modules\GeneralPackageTariffDistributionItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;
use Modules\GeneralPackageTariffDistributionItem\Models\PackageTariffDistributionItem;
use Tests\TestCase;

class PackageTariffDistributionItemControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_items_for_a_distribution(): void
    {
        $this->actingUser();
        $distribution = PackageTariffDistribution::factory()->create();
        PackageTariffDistributionItem::factory()->count(2)->create(['package_tariff_distribution_id' => $distribution->id]);
        PackageTariffDistributionItem::factory()->create();

        $this->getJson("/api/v1/package-tariff-distribution-items?package_tariff_distribution_id={$distribution->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_creates_an_item(): void
    {
        $this->actingUser();
        $distribution = PackageTariffDistribution::factory()->create();

        $response = $this->postJson('/api/v1/package-tariff-distribution-items', [
            'package_tariff_distribution_id' => $distribution->id,
            'recipient_type' => 'dokter',
            'percentage' => 40,
            'amount' => 120000,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('package_tariff_distribution_items', ['recipient_type' => 'dokter', 'amount' => 120000]);
    }

    public function test_it_rejects_unknown_recipient_type(): void
    {
        $this->actingUser();
        $distribution = PackageTariffDistribution::factory()->create();

        $this->postJson('/api/v1/package-tariff-distribution-items', [
            'package_tariff_distribution_id' => $distribution->id,
            'recipient_type' => 'not_a_valid_type',
            'amount' => 100000,
        ])->assertStatus(422);
    }

    public function test_it_deletes_an_item(): void
    {
        $this->actingUser();
        $item = PackageTariffDistributionItem::factory()->create();

        $this->deleteJson("/api/v1/package-tariff-distribution-items/{$item->id}")->assertStatus(204);
    }
}
