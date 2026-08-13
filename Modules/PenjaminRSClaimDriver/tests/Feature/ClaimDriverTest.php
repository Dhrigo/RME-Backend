<?php

namespace Modules\PenjaminRSClaimDriver\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PenjaminRSClaimDriver\Models\ClaimDriver;
use Modules\Auth\Models\User;

class ClaimDriverTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_can_list_claim_drivers()
    {
        ClaimDriver::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/claim-drivers');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create_claim_driver()
    {
        $response = $this->postJson('/api/v1/claim-drivers', [
            'code' => 'DRV1',
            'name' => 'Driver 1'
        ]);

        $response->assertStatus(201)->assertJsonFragment(['code' => 'DRV1']);
        $this->assertDatabaseHas('claim_drivers', ['code' => 'DRV1']);
    }

    public function test_can_update_claim_driver()
    {
        $driver = ClaimDriver::factory()->create(['name' => 'Old']);

        $response = $this->putJson("/api/v1/claim-drivers/{$driver->id}", [
            'name' => 'New'
        ]);

        $response->assertStatus(200);
        $this->assertEquals('New', $driver->fresh()->name);
    }

    public function test_can_delete_claim_driver()
    {
        $driver = ClaimDriver::factory()->create();

        $response = $this->deleteJson("/api/v1/claim-drivers/{$driver->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('claim_drivers', ['id' => $driver->id]);
    }
}
