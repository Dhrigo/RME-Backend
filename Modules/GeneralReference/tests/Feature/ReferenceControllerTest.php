<?php

namespace Modules\GeneralReference\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralReference\Models\Reference;
use Tests\TestCase;

class ReferenceControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_reference_entrys(): void
    {
        $this->actingUser();
        Reference::factory()->count(3)->create();

        $this->getJson('/api/v1/reference-entries')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_reference_entry(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/reference-entries', [
            'category' => 'Test Category',
            'code' => 'Test Code',
            'name' => 'Test Name',
        ])->assertCreated();

        $this->assertDatabaseCount('reference_entries', 1);
    }

    public function test_it_deletes_reference_entry(): void
    {
        $this->actingUser();
        $reference_entry = Reference::factory()->create();

        $this->deleteJson("/api/v1/reference-entries/{$reference_entry->id}")->assertStatus(204);
        $this->assertDatabaseMissing('reference_entries', ['id' => $reference_entry->id]);
    }

    public function test_it_shows_reference_entry(): void
    {
        $this->actingUser();
        $reference_entry = Reference::factory()->create();

        $this->getJson("/api/v1/reference-entries/{$reference_entry->id}")->assertOk()->assertJsonPath('data.id', $reference_entry->id);
    }

}
