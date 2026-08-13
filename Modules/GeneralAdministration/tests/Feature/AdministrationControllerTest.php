<?php

namespace Modules\GeneralAdministration\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAdministration\Models\Administration;
use Tests\TestCase;

class AdministrationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_administrations(): void
    {
        $this->actingUser();
        Administration::factory()->count(3)->create();

        $this->getJson('/api/v1/administrations')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_administration(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/administrations', ['name' => 'Surat Keterangan Rawat Inap', 'code' => 'SKRI'])
            ->assertCreated()
            ->assertJsonPath('name', 'Surat Keterangan Rawat Inap');

        $this->assertDatabaseHas('administrations', ['name' => 'Surat Keterangan Rawat Inap']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        Administration::factory()->create(['name' => 'Surat Rujukan']);

        $this->postJson('/api/v1/administrations', ['name' => 'Surat Rujukan'])->assertStatus(422);
    }

    public function test_it_deletes_administration(): void
    {
        $this->actingUser();
        $administration = Administration::factory()->create();

        $this->deleteJson("/api/v1/administrations/{$administration->id}")->assertStatus(204);
        $this->assertDatabaseMissing('administrations', ['id' => $administration->id]);
    }
}
