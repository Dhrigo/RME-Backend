<?php

namespace Modules\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_username_returns_token(): void
    {
        User::factory()->create(['username' => 'budi']);

        $response = $this->postJson('/api/v1/login', [
            'login' => 'budi',
            'password' => 'password',
        ]);

        $response->assertOk()->assertJsonStructure(['user', 'token']);
    }

    public function test_login_with_email_returns_token(): void
    {
        User::factory()->create(['email' => 'budi@example.com']);

        $response = $this->postJson('/api/v1/login', [
            'login' => 'budi@example.com',
            'password' => 'password',
        ]);

        $response->assertOk()->assertJsonStructure(['user', 'token']);
    }

    public function test_login_with_wrong_password_is_rejected(): void
    {
        User::factory()->create(['username' => 'budi']);

        $response = $this->postJson('/api/v1/login', [
            'login' => 'budi',
            'password' => 'salah',
        ]);

        $response->assertStatus(422);
    }

    public function test_locked_account_cannot_login(): void
    {
        User::factory()->locked()->create(['username' => 'budi']);

        $response = $this->postJson('/api/v1/login', [
            'login' => 'budi',
            'password' => 'password',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('login');
    }

    public function test_inactive_account_cannot_login(): void
    {
        User::factory()->inactive()->create(['username' => 'budi']);

        $response = $this->postJson('/api/v1/login', [
            'login' => 'budi',
            'password' => 'password',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors('login');
    }

    public function test_me_returns_authenticated_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/v1/me');

        $response->assertOk()->assertJsonPath('data.username', $user->username);
    }

    public function test_logout_revokes_current_token(): void
    {
        User::factory()->create(['username' => 'budi']);

        $login = $this->postJson('/api/v1/login', ['login' => 'budi', 'password' => 'password']);
        $token = $login->json('token');

        $response = $this->withHeader('Authorization', "Bearer {$token}")->postJson('/api/v1/logout');

        $response->assertOk();
        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    public function test_guest_cannot_access_protected_routes(): void
    {
        $this->getJson('/api/v1/me')->assertStatus(401);
    }
}
