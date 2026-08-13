<?php

namespace Modules\GeneralDurationRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralDurationRestriction\Models\DurationRestriction;
use Tests\TestCase;

class DurationRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_restrictions(): void
    {
        $this->actingUser();
        DurationRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/duration-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_restriction(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/duration-restrictions', [
            'antibiotic_name' => 'Meropenem',
            'max_days' => 7,
            'min_days' => 3,
        ])->assertCreated()->assertJsonPath('data.max_days', 7);

        $this->assertDatabaseHas('duration_restrictions', ['antibiotic_name' => 'Meropenem', 'max_days' => 7]);
    }

    public function test_it_rejects_min_days_greater_than_max_days(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/duration-restrictions', [
            'antibiotic_name' => 'Colistin',
            'max_days' => 5,
            'min_days' => 10,
        ])->assertStatus(422);
    }

    public function test_it_updates_restriction(): void
    {
        $this->actingUser();
        $restriction = DurationRestriction::factory()->create(['max_days' => 7]);

        $this->putJson("/api/v1/duration-restrictions/{$restriction->id}", ['max_days' => 10])
            ->assertOk()
            ->assertJsonPath('data.max_days', 10);
    }

    public function test_it_deletes_restriction(): void
    {
        $this->actingUser();
        $restriction = DurationRestriction::factory()->create();

        $this->deleteJson("/api/v1/duration-restrictions/{$restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('duration_restrictions', ['id' => $restriction->id]);
    }
}
