<?php

namespace Modules\GeneralGuarantorParticipantType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralGuarantorParticipantType\Models\GuarantorParticipantType;
use Tests\TestCase;

class GuarantorParticipantTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_participant_types(): void
    {
        $this->actingUser();
        GuarantorParticipantType::factory()->count(3)->create();

        $this->getJson('/api/v1/guarantor-participant-types')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_a_participant_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/guarantor-participant-types', [
            'name' => 'Peserta Mandiri',
            'payer_type' => 'bpjs',
            'requires_verification' => true,
        ])->assertCreated()->assertJsonPath('name', 'Peserta Mandiri');

        $this->assertDatabaseHas('guarantor_participant_types', ['name' => 'Peserta Mandiri']);
    }

    public function test_it_rejects_invalid_payer_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/guarantor-participant-types', [
            'name' => 'Tidak Valid',
            'payer_type' => 'crypto',
        ])->assertStatus(422);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        GuarantorParticipantType::factory()->create(['name' => 'PBI APBN']);

        $this->postJson('/api/v1/guarantor-participant-types', ['name' => 'PBI APBN', 'payer_type' => 'bpjs'])
            ->assertStatus(422);
    }

    public function test_it_deletes_a_participant_type(): void
    {
        $this->actingUser();
        $type = GuarantorParticipantType::factory()->create();

        $this->deleteJson("/api/v1/guarantor-participant-types/{$type->id}")->assertStatus(204);
        $this->assertDatabaseMissing('guarantor_participant_types', ['id' => $type->id]);
    }
}
