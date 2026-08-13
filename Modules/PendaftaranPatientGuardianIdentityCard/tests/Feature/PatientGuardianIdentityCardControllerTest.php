<?php

namespace Modules\PendaftaranPatientGuardianIdentityCard\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranPatientGuardianIdentityCard\Models\PatientGuardianIdentityCard;
use Tests\TestCase;

class PatientGuardianIdentityCardControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_a_guardian_identity_card(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();

        $this->postJson('/api/v1/patient-guardian-identity-cards', [
            'patient_guardian_id' => $guardian->id,
            'card_type' => 'KTP',
            'card_number' => '3201234567890001',
        ])
            ->assertCreated()
            ->assertJsonPath('data.card_type', 'KTP');

        $this->assertDatabaseHas('patient_guardian_identity_cards', ['patient_guardian_id' => $guardian->id]);
    }

    public function test_it_rejects_duplicate_card_type_for_same_guardian(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();
        PatientGuardianIdentityCard::factory()->create(['patient_guardian_id' => $guardian->id, 'card_type' => 'KTP']);

        $this->postJson('/api/v1/patient-guardian-identity-cards', [
            'patient_guardian_id' => $guardian->id,
            'card_type' => 'KTP',
            'card_number' => '3201234567890002',
        ])->assertStatus(422);
    }

    public function test_it_rejects_invalid_card_type(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();

        $this->postJson('/api/v1/patient-guardian-identity-cards', [
            'patient_guardian_id' => $guardian->id,
            'card_type' => 'NPWP',
            'card_number' => '123456',
        ])->assertStatus(422);
    }

    public function test_it_deletes_a_guardian_identity_card(): void
    {
        $this->actingUser();
        $card = PatientGuardianIdentityCard::factory()->create();

        $this->deleteJson("/api/v1/patient-guardian-identity-cards/{$card->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_guardian_identity_cards', ['id' => $card->id]);
    }

    public function test_guest_cannot_access_guardian_identity_cards(): void
    {
        $this->getJson('/api/v1/patient-guardian-identity-cards')->assertStatus(401);
    }
}
