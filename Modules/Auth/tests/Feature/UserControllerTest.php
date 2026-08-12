<?php

namespace Modules\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_users(): void
    {
        $this->actingUser();
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/users');

        $response->assertOk()->assertJsonCount(4, 'data');
    }

    public function test_it_creates_user(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/users', [
            'name' => 'Siti',
            'username' => 'siti',
            'email' => 'siti@example.com',
            'password' => 'Rahasia123',
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', ['username' => 'siti']);
    }

    public function test_it_updates_user(): void
    {
        $this->actingUser();
        $target = User::factory()->create();

        $response = $this->putJson("/api/v1/users/{$target->id}", ['name' => 'Baru']);

        $response->assertOk()->assertJsonPath('data.name', 'Baru');
    }

    public function test_it_deletes_user(): void
    {
        $this->actingUser();
        $target = User::factory()->create();

        $response = $this->deleteJson("/api/v1/users/{$target->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('users', ['id' => $target->id]);
    }
}
