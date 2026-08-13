<?php

namespace Modules\PendaftaranPatientEscortContact\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranPatientEscortContact\Models\PatientEscortContact;
use Tests\TestCase;

class PatientEscortContactControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_an_escort_contact(): void
    {
        $this->actingUser();
        $escort = PatientEscort::factory()->create();

        $this->postJson('/api/v1/patient-escort-contacts', [
            'patient_escort_id' => $escort->id,
            'contact_type' => 'phone',
            'contact_value' => '0219876543',
        ])
            ->assertCreated()
            ->assertJsonPath('data.contact_type', 'phone');

        $this->assertDatabaseHas('patient_escort_contacts', ['patient_escort_id' => $escort->id]);
    }

    public function test_it_rejects_invalid_contact_type(): void
    {
        $this->actingUser();
        $escort = PatientEscort::factory()->create();

        $this->postJson('/api/v1/patient-escort-contacts', [
            'patient_escort_id' => $escort->id,
            'contact_type' => 'telegram',
            'contact_value' => '@budi',
        ])->assertStatus(422);
    }

    public function test_it_lists_contacts_filtered_by_escort(): void
    {
        $this->actingUser();
        $escort = PatientEscort::factory()->create();
        PatientEscortContact::factory()->create(['patient_escort_id' => $escort->id]);
        PatientEscortContact::factory()->create();

        $this->getJson("/api/v1/patient-escort-contacts?patient_escort_id={$escort->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_it_deletes_an_escort_contact(): void
    {
        $this->actingUser();
        $contact = PatientEscortContact::factory()->create();

        $this->deleteJson("/api/v1/patient-escort-contacts/{$contact->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_escort_contacts', ['id' => $contact->id]);
    }

    public function test_guest_cannot_access_escort_contacts(): void
    {
        $this->getJson('/api/v1/patient-escort-contacts')->assertStatus(401);
    }
}
