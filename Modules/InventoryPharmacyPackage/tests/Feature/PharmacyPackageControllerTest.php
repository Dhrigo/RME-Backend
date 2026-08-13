<?php

namespace Modules\InventoryPharmacyPackage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\InventoryPharmacyPackage\Models\PharmacyPackage;
use Tests\TestCase;

class PharmacyPackageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_pharmacy_packages(): void
    {
        $this->actingUser();
        PharmacyPackage::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/pharmacy-packages');

        $response->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_a_pharmacy_package(): void
    {
        $this->actingUser();
        $response = $this->postJson('/api/v1/pharmacy-packages', [
            'package_code' => 'PKF-00001',
            'name' => 'Paket Luka Ringan',
            'category' => 'alkes',
            'price' => 150000,
            'description' => 'Perban, kasa, betadine',
        ]);

        $response->assertCreated()->assertJsonPath('data.package_code', 'PKF-00001');
        $this->assertDatabaseHas('pharmacy_packages', ['package_code' => 'PKF-00001']);
    }

    public function test_it_rejects_duplicate_package_code(): void
    {
        $this->actingUser();
        PharmacyPackage::factory()->create(['package_code' => 'PKF-00002']);

        $response = $this->postJson('/api/v1/pharmacy-packages', [
            'package_code' => 'PKF-00002',
            'name' => 'Paket Lain',
            'category' => 'obat',
            'price' => 100000,
        ]);

        $response->assertStatus(422);
    }

    public function test_it_updates_a_pharmacy_package(): void
    {
        $this->actingUser();
        $package = PharmacyPackage::factory()->create(['price' => 100000]);

        $response = $this->putJson("/api/v1/pharmacy-packages/{$package->id}", ['price' => 175000]);

        $response->assertOk()->assertJsonPath('data.price', '175000.00');
        $this->assertEquals(175000, $package->fresh()->price);
    }

    public function test_it_deletes_a_pharmacy_package(): void
    {
        $this->actingUser();
        $package = PharmacyPackage::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-packages/{$package->id}")->assertNoContent();
        $this->assertDatabaseMissing('pharmacy_packages', ['id' => $package->id]);
    }

    public function test_guest_cannot_access_pharmacy_packages(): void
    {
        $this->getJson('/api/v1/pharmacy-packages')->assertStatus(401);
    }
}
