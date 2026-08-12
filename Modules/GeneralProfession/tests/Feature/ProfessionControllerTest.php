<?php

namespace Modules\GeneralProfession\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralProfession\Models\Profession;
use Tests\TestCase;

class ProfessionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_professions(): void
    {
        $this->actingUser();
        Profession::factory()->count(2)->create();

        $this->getJson('/api/v1/professions')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_creates_profession(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/professions', ['name' => 'Dokter Umum'])
            ->assertCreated()
            ->assertJsonPath('name', 'Dokter Umum');
    }

    public function test_it_deletes_profession(): void
    {
        $this->actingUser();
        $profession = Profession::factory()->create();

        $this->deleteJson("/api/v1/professions/{$profession->id}")->assertStatus(204);
    }
}
