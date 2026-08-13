<?php

namespace Modules\GeneralPharmacyDepot\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPharmacyDepot\Models\PharmacyDepot;
use Tests\TestCase;

class PharmacyDepotControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_pharmacy_depots(): void
    {
        $this->actingUser();
        PharmacyDepot::factory()->count(3)->create();

        $this->getJson('/api/v1/pharmacy-depots')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_pharmacy_depot(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/pharmacy-depots', [
            'code' => 'Test Code',
            'name' => 'Test Name',
        ])->assertCreated();

        $this->assertDatabaseCount('pharmacy_depots', 1);
    }

    public function test_it_deletes_pharmacy_depot(): void
    {
        $this->actingUser();
        $pharmacy_depot = PharmacyDepot::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-depots/{$pharmacy_depot->id}")->assertStatus(204);
        $this->assertDatabaseMissing('pharmacy_depots', ['id' => $pharmacy_depot->id]);
    }

    public function test_it_shows_pharmacy_depot(): void
    {
        $this->actingUser();
        $pharmacy_depot = PharmacyDepot::factory()->create();

        $this->getJson("/api/v1/pharmacy-depots/{$pharmacy_depot->id}")->assertOk()->assertJsonPath('data.id', $pharmacy_depot->id);
    }

}
