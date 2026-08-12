<?php

namespace Modules\GeneralWardType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWardType\Models\WardType;
use Tests\TestCase;

class WardTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_ward_types(): void
    {
        $this->actingUser();
        WardType::factory()->count(3)->create();

        $this->getJson('/api/v1/ward-types')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_ward_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ward-types', ['name' => 'ICU', 'code' => 'ICU'])
            ->assertCreated()
            ->assertJsonPath('name', 'ICU');

        $this->assertDatabaseHas('ward_types', ['name' => 'ICU']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        WardType::factory()->create(['name' => 'ICU']);

        $this->postJson('/api/v1/ward-types', ['name' => 'ICU'])->assertStatus(422);
    }

    public function test_it_deletes_ward_type(): void
    {
        $this->actingUser();
        $type = WardType::factory()->create();

        $this->deleteJson("/api/v1/ward-types/{$type->id}")->assertStatus(204);
        $this->assertDatabaseMissing('ward_types', ['id' => $type->id]);
    }
}
