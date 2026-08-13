<?php

namespace Modules\GeneralWardTransferRoute\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWardTransferRoute\Models\WardTransferRoute;
use Tests\TestCase;

class WardTransferRouteControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_transfer_routes(): void
    {
        $this->actingUser();
        WardTransferRoute::factory()->count(3)->create();

        $this->getJson('/api/v1/ward-transfer-routes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_transfer_route(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ward-transfer-routes', [
            'from_ward_id' => \Modules\GeneralWard\Models\Ward::factory()->create()->id,
            'to_ward_id' => \Modules\GeneralWard\Models\Ward::factory()->create()->id,
        ])->assertCreated();

        $this->assertDatabaseCount('ward_transfer_routes', 1);
    }

    public function test_it_deletes_transfer_route(): void
    {
        $this->actingUser();
        $transfer_route = WardTransferRoute::factory()->create();

        $this->deleteJson("/api/v1/ward-transfer-routes/{$transfer_route->id}")->assertStatus(204);
        $this->assertDatabaseMissing('ward_transfer_routes', ['id' => $transfer_route->id]);
    }

    public function test_it_shows_transfer_route(): void
    {
        $this->actingUser();
        $transfer_route = WardTransferRoute::factory()->create();

        $this->getJson("/api/v1/ward-transfer-routes/{$transfer_route->id}")->assertOk()->assertJsonPath('data.id', $transfer_route->id);
    }

}
