<?php

namespace Modules\Authorization\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_role_with_permissions(): void
    {
        $this->actingUser();
        Permission::create(['name' => 'edit-pasien']);

        $response = $this->postJson('/api/v1/roles', [
            'name' => 'admin',
            'permissions' => ['edit-pasien'],
        ]);

        $response->assertCreated()->assertJsonPath('data.name', 'admin');
        $this->assertDatabaseHas('roles', ['name' => 'admin']);
    }

    public function test_it_lists_roles(): void
    {
        $this->actingUser();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'staff']);

        $response = $this->getJson('/api/v1/roles');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_syncs_role_permissions_on_update(): void
    {
        $this->actingUser();
        $role = Role::create(['name' => 'staff']);
        Permission::create(['name' => 'view-pasien']);

        $response = $this->putJson("/api/v1/roles/{$role->id}", [
            'permissions' => ['view-pasien'],
        ]);

        $response->assertOk()->assertJsonPath('data.permissions.0', 'view-pasien');
    }

    public function test_it_deletes_role(): void
    {
        $this->actingUser();
        $role = Role::create(['name' => 'staff']);

        $response = $this->deleteJson("/api/v1/roles/{$role->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }
}
