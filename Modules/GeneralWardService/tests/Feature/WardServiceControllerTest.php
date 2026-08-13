<?php

namespace Modules\GeneralWardService\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWardService\Models\WardService;
use Tests\TestCase;

class WardServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_ward_services(): void
    {
        $this->actingUser();
        WardService::factory()->count(3)->create();

        $this->getJson('/api/v1/ward-services')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_ward_service(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ward-services', [
            'ward_id' => \Modules\GeneralWard\Models\Ward::factory()->create()->id,
            'service_id' => \Modules\GeneralService\Models\Service::factory()->create()->id,
        ])->assertCreated();

        $this->assertDatabaseCount('ward_services', 1);
    }

    public function test_it_deletes_ward_service(): void
    {
        $this->actingUser();
        $ward_service = WardService::factory()->create();

        $this->deleteJson("/api/v1/ward-services/{$ward_service->id}")->assertStatus(204);
        $this->assertDatabaseMissing('ward_services', ['id' => $ward_service->id]);
    }

    public function test_it_shows_ward_service(): void
    {
        $this->actingUser();
        $ward_service = WardService::factory()->create();

        $this->getJson("/api/v1/ward-services/{$ward_service->id}")->assertOk()->assertJsonPath('data.id', $ward_service->id);
    }

}
