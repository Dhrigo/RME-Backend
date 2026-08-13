<?php

namespace Modules\GeneralReferenceMap\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralReferenceMap\Models\ReferenceMap;
use Tests\TestCase;

class ReferenceMapControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_reference_maps(): void
    {
        $this->actingUser();
        ReferenceMap::factory()->count(3)->create();

        $this->getJson('/api/v1/reference-maps')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_reference_map(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/reference-maps', [
            'source_system' => 'Test Source_system',
            'source_code' => 'Test Source_code',
            'target_category' => 'Test Target_category',
            'target_code' => 'Test Target_code',
        ])->assertCreated();

        $this->assertDatabaseCount('reference_maps', 1);
    }

    public function test_it_deletes_reference_map(): void
    {
        $this->actingUser();
        $reference_map = ReferenceMap::factory()->create();

        $this->deleteJson("/api/v1/reference-maps/{$reference_map->id}")->assertStatus(204);
        $this->assertDatabaseMissing('reference_maps', ['id' => $reference_map->id]);
    }

    public function test_it_shows_reference_map(): void
    {
        $this->actingUser();
        $reference_map = ReferenceMap::factory()->create();

        $this->getJson("/api/v1/reference-maps/{$reference_map->id}")->assertOk()->assertJsonPath('data.id', $reference_map->id);
    }

}
