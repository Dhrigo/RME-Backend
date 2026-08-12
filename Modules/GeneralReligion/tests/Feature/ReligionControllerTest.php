<?php

namespace Modules\GeneralReligion\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralReligion\Models\Religion;
use Tests\TestCase;

class ReligionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_religions(): void
    {
        $this->actingUser();
        Religion::factory()->count(3)->create();

        $this->getJson('/api/v1/religions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_religion(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/religions', ['name' => 'Islam', 'code' => 'ISL'])
            ->assertCreated()
            ->assertJsonPath('name', 'Islam');

        $this->assertDatabaseHas('religions', ['name' => 'Islam']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        Religion::factory()->create(['name' => 'Islam']);

        $this->postJson('/api/v1/religions', ['name' => 'Islam'])->assertStatus(422);
    }

    public function test_it_deletes_religion(): void
    {
        $this->actingUser();
        $religion = Religion::factory()->create();

        $this->deleteJson("/api/v1/religions/{$religion->id}")->assertStatus(204);
        $this->assertDatabaseMissing('religions', ['id' => $religion->id]);
    }
}
