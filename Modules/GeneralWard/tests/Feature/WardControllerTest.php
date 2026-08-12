<?php

namespace Modules\GeneralWard\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class WardControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_wards(): void
    {
        $this->actingUser();
        Ward::factory()->count(2)->create();

        $this->getJson('/api/v1/wards')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_creates_ward(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/wards', ['name' => 'IGD'])
            ->assertCreated()
            ->assertJsonPath('name', 'IGD');
    }

    public function test_it_deletes_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->deleteJson("/api/v1/wards/{$ward->id}")->assertStatus(204);
    }
}
