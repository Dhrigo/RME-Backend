<?php

namespace Modules\GeneralPatientContact\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientContact\Models\PatientContact;
use Tests\TestCase;

class PatientContactControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_contact(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/patient-contacts', [
            'patient_id' => $patient->id,
            'contact_type' => 'telepon_seluler',
            'contact_value' => '081234567890',
            'is_primary' => true,
        ]);

        $response->assertCreated()->assertJsonPath('data.contact_value', '081234567890');
        $this->assertDatabaseHas('patient_contacts', ['patient_id' => $patient->id, 'is_primary' => true]);
    }

    public function test_setting_new_primary_demotes_previous_primary(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $existing = PatientContact::factory()->create(['patient_id' => $patient->id, 'is_primary' => true]);

        $this->postJson('/api/v1/patient-contacts', [
            'patient_id' => $patient->id,
            'contact_type' => 'email',
            'contact_value' => 'pasien@example.com',
            'is_primary' => true,
        ])->assertCreated();

        $this->assertFalse($existing->fresh()->is_primary);
    }

    public function test_it_lists_contacts_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        PatientContact::factory()->create(['patient_id' => $patient->id]);
        PatientContact::factory()->create();

        $response = $this->getJson("/api/v1/patient-contacts?patient_id={$patient->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_it_rejects_invalid_contact_type(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/patient-contacts', [
            'patient_id' => $patient->id,
            'contact_type' => 'carrier_pigeon',
            'contact_value' => 'n/a',
        ])->assertStatus(422);
    }

    public function test_it_deletes_a_contact(): void
    {
        $this->actingUser();
        $contact = PatientContact::factory()->create();

        $this->deleteJson("/api/v1/patient-contacts/{$contact->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_contacts', ['id' => $contact->id]);
    }

    public function test_guest_cannot_access_patient_contacts(): void
    {
        $this->getJson('/api/v1/patient-contacts')->assertStatus(401);
    }
}
