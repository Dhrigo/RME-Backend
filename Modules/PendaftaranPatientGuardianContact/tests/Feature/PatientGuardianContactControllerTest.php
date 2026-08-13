<?php

namespace Modules\PendaftaranPatientGuardianContact\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranPatientGuardianContact\Models\PatientGuardianContact;
use Tests\TestCase;

class PatientGuardianContactControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_a_guardian_contact(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();

        $this->postJson('/api/v1/patient-guardian-contacts', [
            'patient_guardian_id' => $guardian->id,
            'contact_type' => 'whatsapp',
            'contact_value' => '081234567890',
            'is_primary' => true,
        ])
            ->assertCreated()
            ->assertJsonPath('data.contact_type', 'whatsapp');

        $this->assertDatabaseHas('patient_guardian_contacts', ['patient_guardian_id' => $guardian->id]);
    }

    public function test_it_rejects_invalid_contact_type(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();

        $this->postJson('/api/v1/patient-guardian-contacts', [
            'patient_guardian_id' => $guardian->id,
            'contact_type' => 'fax',
            'contact_value' => '021123456',
        ])->assertStatus(422);
    }

    public function test_it_lists_contacts_filtered_by_guardian(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();
        PatientGuardianContact::factory()->create(['patient_guardian_id' => $guardian->id]);
        PatientGuardianContact::factory()->create();

        $this->getJson("/api/v1/patient-guardian-contacts?patient_guardian_id={$guardian->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_it_deletes_a_guardian_contact(): void
    {
        $this->actingUser();
        $contact = PatientGuardianContact::factory()->create();

        $this->deleteJson("/api/v1/patient-guardian-contacts/{$contact->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_guardian_contacts', ['id' => $contact->id]);
    }

    public function test_guest_cannot_access_guardian_contacts(): void
    {
        $this->getJson('/api/v1/patient-guardian-contacts')->assertStatus(401);
    }
}
