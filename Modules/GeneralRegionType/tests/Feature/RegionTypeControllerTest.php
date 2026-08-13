<?php

namespace Modules\GeneralRegionType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralRegionType\Models\RegionType;
use Tests\TestCase;

class RegionTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_region_types(): void
    {
        $this->actingUser();
        RegionType::factory()->count(3)->create();

        $this->getJson('/api/v1/region-types')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_region_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/region-types', ['name' => 'Provinsi', 'digit_count' => 2])
            ->assertCreated()
            ->assertJsonPath('name', 'Provinsi');

        $this->assertDatabaseHas('region_types', ['name' => 'Provinsi']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        RegionType::factory()->create(['name' => 'Provinsi']);

        $this->postJson('/api/v1/region-types', ['name' => 'Provinsi'])->assertStatus(422);
    }

    public function test_it_deletes_region_type(): void
    {
        $this->actingUser();
        $regionType = RegionType::factory()->create();

        $this->deleteJson("/api/v1/region-types/{$regionType->id}")->assertStatus(204);
        $this->assertDatabaseMissing('region_types', ['id' => $regionType->id]);
    }
}
