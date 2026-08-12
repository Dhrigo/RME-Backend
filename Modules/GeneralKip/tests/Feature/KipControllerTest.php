<?php

namespace Modules\GeneralKip\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralKip\Models\Kip;
use Tests\TestCase;

class KipControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_kips(): void
    {
        $this->actingUser();
        Kip::factory()->count(3)->create();

        $this->getJson('/api/v1/kips')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_kip(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/kips', [
            'patient_norm' => '0001234567',
            'card_type' => 'KTP',
            'card_number' => '3201234567890001',
        ])
            ->assertCreated()
            ->assertJsonPath('patient_norm', '0001234567');

        $this->assertDatabaseHas('kips', ['patient_norm' => '0001234567']);
    }

    public function test_it_rejects_duplicate_patient_card_type(): void
    {
        $this->actingUser();
        Kip::factory()->create(['patient_norm' => '0001234567', 'card_type' => 'KTP']);

        $this->postJson('/api/v1/kips', [
            'patient_norm' => '0001234567',
            'card_type' => 'KTP',
            'card_number' => '3201234567890001',
        ])->assertStatus(422);
    }

    public function test_it_deletes_kip(): void
    {
        $this->actingUser();
        $kip = Kip::factory()->create();

        $this->deleteJson("/api/v1/kips/{$kip->id}")->assertStatus(204);
        $this->assertDatabaseMissing('kips', ['id' => $kip->id]);
    }
}
