<?php

namespace Modules\Authorization\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_and_lists_permissions(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $this->postJson('/api/v1/permissions', ['name' => 'edit-pasien'])->assertCreated();

        $response = $this->getJson('/api/v1/permissions');

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_deletes_permission(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');
        $permission = Permission::create(['name' => 'edit-pasien']);

        $response = $this->deleteJson("/api/v1/permissions/{$permission->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('permissions', ['id' => $permission->id]);
    }
}
