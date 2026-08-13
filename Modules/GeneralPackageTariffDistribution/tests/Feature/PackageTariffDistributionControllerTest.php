<?php

namespace Modules\GeneralPackageTariffDistribution\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPackage\Models\Package;
use Modules\GeneralPackageTariffDistribution\Models\PackageTariffDistribution;
use Tests\TestCase;

class PackageTariffDistributionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_distributions_for_a_package(): void
    {
        $this->actingUser();
        $package = Package::factory()->create();
        PackageTariffDistribution::factory()->count(2)->create(['package_id' => $package->id]);
        PackageTariffDistribution::factory()->create();

        $this->getJson("/api/v1/package-tariff-distributions?package_id={$package->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_creates_a_distribution(): void
    {
        $this->actingUser();
        $package = Package::factory()->create();

        $response = $this->postJson('/api/v1/package-tariff-distributions', [
            'package_id' => $package->id,
            'component_name' => 'jasa_dokter',
            'percentage' => 30,
            'amount' => 300000,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('package_tariff_distributions', ['package_id' => $package->id, 'component_name' => 'jasa_dokter']);
    }

    public function test_it_rejects_unknown_component(): void
    {
        $this->actingUser();
        $package = Package::factory()->create();

        $this->postJson('/api/v1/package-tariff-distributions', [
            'package_id' => $package->id,
            'component_name' => 'not_a_valid_component',
            'amount' => 100000,
        ])->assertStatus(422);
    }

    public function test_it_deletes_a_distribution(): void
    {
        $this->actingUser();
        $distribution = PackageTariffDistribution::factory()->create();

        $this->deleteJson("/api/v1/package-tariff-distributions/{$distribution->id}")->assertStatus(204);
    }
}
