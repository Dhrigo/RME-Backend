<?php

namespace Modules\GeneralKap\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralKap\Models\Kap;
use Tests\TestCase;

class KapControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_kaps(): void
    {
        $this->actingUser();
        Kap::factory()->count(3)->create();

        $this->getJson('/api/v1/kaps')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_kap(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/kaps', [
            'patient_norm' => '0001234567',
            'card_type' => 'BPJS',
            'card_number' => '0000012345678901',
        ])
            ->assertCreated()
            ->assertJsonPath('patient_norm', '0001234567');

        $this->assertDatabaseHas('kaps', ['patient_norm' => '0001234567']);
    }

    public function test_it_rejects_duplicate_patient_card_type(): void
    {
        $this->actingUser();
        Kap::factory()->create(['patient_norm' => '0001234567', 'card_type' => 'BPJS']);

        $this->postJson('/api/v1/kaps', [
            'patient_norm' => '0001234567',
            'card_type' => 'BPJS',
            'card_number' => '0000012345678901',
        ])->assertStatus(422);
    }

    public function test_it_deletes_kap(): void
    {
        $this->actingUser();
        $kap = Kap::factory()->create();

        $this->deleteJson("/api/v1/kaps/{$kap->id}")->assertStatus(204);
        $this->assertDatabaseMissing('kaps', ['id' => $kap->id]);
    }
}
