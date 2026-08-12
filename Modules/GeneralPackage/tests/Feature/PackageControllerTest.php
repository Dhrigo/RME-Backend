<?php

namespace Modules\GeneralPackage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPackage\Models\Package;
use Tests\TestCase;

class PackageControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_package(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/packages', [
            'name' => 'Medical Check-Up Basic',
            'price' => 500000,
        ]);

        $response->assertCreated()->assertJsonPath('data.name', 'Medical Check-Up Basic');
    }

    public function test_it_lists_packages_filtered_by_name(): void
    {
        $this->actingUser();
        Package::factory()->create(['name' => 'MCU Basic']);
        Package::factory()->create(['name' => 'Persalinan Normal']);

        $response = $this->getJson('/api/v1/packages?name=MCU');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_updates_a_package(): void
    {
        $this->actingUser();
        $package = Package::factory()->create(['price' => 100000]);

        $response = $this->putJson("/api/v1/packages/{$package->id}", ['price' => 150000]);

        $response->assertOk()->assertJsonPath('data.price', '150000.00');
    }

    public function test_it_deletes_a_package(): void
    {
        $this->actingUser();
        $package = Package::factory()->create();

        $this->deleteJson("/api/v1/packages/{$package->id}")->assertNoContent();
        $this->assertDatabaseMissing('packages', ['id' => $package->id]);
    }

    public function test_guest_cannot_access_packages(): void
    {
        $this->getJson('/api/v1/packages')->assertStatus(401);
    }
}
