<?php

namespace Modules\PenjaminRSDischargeMethod\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PenjaminRSDischargeMethod\Models\DischargeMethod;
use Tests\TestCase;

class DischargeMethodControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_discharge_methods(): void
    {
        $this->actingUser();
        DischargeMethod::factory()->count(3)->create();

        $this->getJson('/api/v1/discharge-methods')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_discharge_method(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/discharge-methods', ['name' => 'Pulang Paksa', 'code' => 'PP'])
            ->assertCreated()
            ->assertJsonPath('name', 'Pulang Paksa');

        $this->assertDatabaseHas('discharge_methods', ['name' => 'Pulang Paksa']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        DischargeMethod::factory()->create(['name' => 'Pulang Paksa']);

        $this->postJson('/api/v1/discharge-methods', ['name' => 'Pulang Paksa'])->assertStatus(422);
    }

    public function test_it_updates_discharge_method(): void
    {
        $this->actingUser();
        $dischargeMethod = DischargeMethod::factory()->create();

        $this->patchJson("/api/v1/discharge-methods/{$dischargeMethod->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('is_active', false);
    }

    public function test_it_deletes_discharge_method(): void
    {
        $this->actingUser();
        $dischargeMethod = DischargeMethod::factory()->create();

        $this->deleteJson("/api/v1/discharge-methods/{$dischargeMethod->id}")->assertStatus(204);
        $this->assertDatabaseMissing('discharge_methods', ['id' => $dischargeMethod->id]);
    }
}