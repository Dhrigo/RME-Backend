<?php

namespace Modules\PendaftaranFunction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranFunction\Models\RegistrationFunction;
use Tests\TestCase;

class PendaftaranFunctionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_registration_functions(): void
    {
        $this->actingUser();
        RegistrationFunction::factory()->count(3)->create();

        $this->getJson('/api/v1/registration-functions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_a_registration_function(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/registration-functions', ['code' => 'FUNC-001', 'name' => 'Loket Pendaftaran'])
            ->assertCreated()
            ->assertJsonPath('name', 'Loket Pendaftaran');

        $this->assertDatabaseHas('registration_functions', ['code' => 'FUNC-001']);
    }

    public function test_it_rejects_duplicate_code(): void
    {
        $this->actingUser();
        RegistrationFunction::factory()->create(['code' => 'FUNC-002']);

        $this->postJson('/api/v1/registration-functions', ['code' => 'FUNC-002', 'name' => 'Lain'])
            ->assertStatus(422);
    }

    public function test_it_updates_a_registration_function(): void
    {
        $this->actingUser();
        $function = RegistrationFunction::factory()->create(['name' => 'Old']);

        $this->putJson("/api/v1/registration-functions/{$function->id}", ['name' => 'New'])
            ->assertOk()->assertJsonPath('name', 'New');
    }

    public function test_it_deletes_a_registration_function(): void
    {
        $this->actingUser();
        $function = RegistrationFunction::factory()->create();

        $this->deleteJson("/api/v1/registration-functions/{$function->id}")->assertStatus(204);
        $this->assertDatabaseMissing('registration_functions', ['id' => $function->id]);
    }

    public function test_guest_cannot_access_registration_functions(): void
    {
        $this->getJson('/api/v1/registration-functions')->assertStatus(401);
    }
}
