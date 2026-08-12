<?php

namespace Modules\Authorization\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserRoleControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_assigns_roles_to_user(): void
    {
        $actor = User::factory()->create();
        $this->actingAs($actor, 'sanctum');

        $target = User::factory()->create();
        Role::create(['name' => 'staff']);

        $response = $this->putJson("/api/v1/users/{$target->id}/roles", [
            'roles' => ['staff'],
        ]);

        $response->assertOk()->assertJsonPath('roles.0', 'staff');
        $this->assertTrue($target->fresh()->hasRole('staff'));
    }

    public function test_it_lists_user_roles(): void
    {
        $actor = User::factory()->create();
        $this->actingAs($actor, 'sanctum');

        Role::create(['name' => 'staff']);
        $actor->assignRole('staff');

        $response = $this->getJson("/api/v1/users/{$actor->id}/roles");

        $response->assertOk()->assertJsonPath('roles.0', 'staff');
    }
}
