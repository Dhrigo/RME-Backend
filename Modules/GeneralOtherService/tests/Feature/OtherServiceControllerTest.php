<?php

namespace Modules\GeneralOtherService\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralOtherService\Models\OtherService;
use Tests\TestCase;

class OtherServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_other_services(): void
    {
        $this->actingUser();
        OtherService::factory()->count(3)->create();

        $this->getJson('/api/v1/other-services')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_other_service(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/other-services', [
            'name' => 'Fotokopi Rekam Medis',
            'code' => 'FRM',
            'unit' => 'per lembar',
        ])->assertCreated()->assertJsonPath('name', 'Fotokopi Rekam Medis');

        $this->assertDatabaseHas('other_services', ['name' => 'Fotokopi Rekam Medis']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        OtherService::factory()->create(['name' => 'Ambulance Non Medis']);

        $this->postJson('/api/v1/other-services', ['name' => 'Ambulance Non Medis'])->assertStatus(422);
    }

    public function test_it_updates_other_service(): void
    {
        $this->actingUser();
        $service = OtherService::factory()->create(['unit' => 'per hari']);

        $this->putJson("/api/v1/other-services/{$service->id}", ['unit' => 'per jam'])
            ->assertOk()
            ->assertJsonPath('unit', 'per jam');
    }

    public function test_it_deletes_other_service(): void
    {
        $this->actingUser();
        $service = OtherService::factory()->create();

        $this->deleteJson("/api/v1/other-services/{$service->id}")->assertStatus(204);
        $this->assertDatabaseMissing('other_services', ['id' => $service->id]);
    }
}
