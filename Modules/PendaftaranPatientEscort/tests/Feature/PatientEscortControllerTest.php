<?php

namespace Modules\PendaftaranPatientEscort\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientEscort\Models\PatientEscort;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class PatientEscortControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_patient_escort(): void
    {
        $user = $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/patient-escorts', [
            'registration_id' => $registration->id,
            'full_name' => 'Budi Santoso',
            'relationship_to_patient' => 'spouse',
            'phone_number' => '081234567890',
            'arrival_mode' => 'ambulance',
        ]);

        $response->assertCreated()->assertJsonPath('data.relationship_to_patient', 'spouse');
        $this->assertDatabaseHas('patient_escorts', ['registration_id' => $registration->id, 'created_by' => $user->id]);
    }

    public function test_it_rejects_invalid_relationship(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/patient-escorts', [
            'registration_id' => $registration->id,
            'full_name' => 'Budi Santoso',
            'relationship_to_patient' => 'neighbor',
        ])->assertStatus(422);
    }

    public function test_it_lists_escorts_filtered_by_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        PatientEscort::factory()->create(['registration_id' => $registration->id]);
        PatientEscort::factory()->create();

        $this->getJson("/api/v1/patient-escorts?registration_id={$registration->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_it_updates_a_patient_escort(): void
    {
        $this->actingUser();
        $escort = PatientEscort::factory()->create(['full_name' => 'Budi Santoso']);

        $this->putJson("/api/v1/patient-escorts/{$escort->id}", ['full_name' => 'Budi Santoso Jr.'])
            ->assertOk()
            ->assertJsonPath('data.full_name', 'Budi Santoso Jr.');
    }

    public function test_it_deletes_a_patient_escort(): void
    {
        $this->actingUser();
        $escort = PatientEscort::factory()->create();

        $this->deleteJson("/api/v1/patient-escorts/{$escort->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_escorts', ['id' => $escort->id]);
    }

    public function test_guest_cannot_access_patient_escorts(): void
    {
        $this->getJson('/api/v1/patient-escorts')->assertStatus(401);
    }
}
