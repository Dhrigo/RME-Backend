<?php

namespace Modules\GeneralPpk\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPpk\Models\Ppk;
use Tests\TestCase;

class PpkControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'RSUD Sejahtera',
            'class' => 'B',
            'address' => 'Jl. Kesehatan No. 1',
            'fax' => '021-1234567',
            'region_name' => 'Kota Jakarta',
        ], $overrides);
    }

    public function test_it_lists_ppks(): void
    {
        $this->actingUser();
        Ppk::factory()->count(3)->create();

        $this->getJson('/api/v1/ppks')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_ppk(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ppks', $this->payload())
            ->assertCreated()
            ->assertJsonPath('name', 'RSUD Sejahtera');

        $this->assertDatabaseHas('ppks', ['name' => 'RSUD Sejahtera']);
    }

    public function test_it_rejects_missing_required_fields(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ppks', ['name' => 'RSUD Sejahtera'])->assertStatus(422);
    }

    public function test_it_updates_ppk(): void
    {
        $this->actingUser();
        $ppk = Ppk::factory()->create();

        $this->putJson("/api/v1/ppks/{$ppk->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('is_active', false);
    }

    public function test_it_deletes_ppk(): void
    {
        $this->actingUser();
        $ppk = Ppk::factory()->create();

        $this->deleteJson("/api/v1/ppks/{$ppk->id}")->assertStatus(204);
        $this->assertDatabaseMissing('ppks', ['id' => $ppk->id]);
    }
}
