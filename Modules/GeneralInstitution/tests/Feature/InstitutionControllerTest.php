<?php

namespace Modules\GeneralInstitution\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralInstitution\Models\Institution;
use Tests\TestCase;

class InstitutionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_institutions(): void
    {
        $this->actingUser();
        Institution::factory()->count(3)->create();

        $this->getJson('/api/v1/institutions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_institution(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/institutions', ['email' => 'contact@rs.go.id', 'website' => 'rs.go.id'])
            ->assertCreated()
            ->assertJsonPath('email', 'contact@rs.go.id');

        $this->assertDatabaseHas('institutions', ['email' => 'contact@rs.go.id']);
    }

    public function test_it_rejects_invalid_email(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/institutions', ['email' => 'not-an-email', 'website' => 'rs.go.id'])
            ->assertStatus(422);
    }

    public function test_it_deletes_institution(): void
    {
        $this->actingUser();
        $institution = Institution::factory()->create();

        $this->deleteJson("/api/v1/institutions/{$institution->id}")->assertStatus(204);
        $this->assertDatabaseMissing('institutions', ['id' => $institution->id]);
    }
}
