<?php

namespace Modules\PendaftaranPatientGuardian\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientGuardian\Models\PatientGuardian;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class PatientGuardianControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_patient_guardian(): void
    {
        $user = $this->actingUser();
        $registration = Registration::factory()->create();

        $response = $this->postJson('/api/v1/patient-guardians', [
            'registration_id' => $registration->id,
            'full_name' => 'Siti Aminah',
            'relationship_to_patient' => 'parent',
            'identity_number' => '3201234567890001',
            'phone_number' => '081234567890',
        ]);

        $response->assertCreated()->assertJsonPath('data.relationship_to_patient', 'parent');
        $this->assertDatabaseHas('patient_guardians', ['registration_id' => $registration->id, 'created_by' => $user->id]);
    }

    public function test_it_rejects_invalid_relationship(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();

        $this->postJson('/api/v1/patient-guardians', [
            'registration_id' => $registration->id,
            'full_name' => 'Siti Aminah',
            'relationship_to_patient' => 'employer',
        ])->assertStatus(422);
    }

    public function test_it_lists_guardians_filtered_by_registration(): void
    {
        $this->actingUser();
        $registration = Registration::factory()->create();
        PatientGuardian::factory()->create(['registration_id' => $registration->id]);
        PatientGuardian::factory()->create();

        $this->getJson("/api/v1/patient-guardians?registration_id={$registration->id}")
            ->assertOk()
            ->assertJsonCount(1, 'data');
    }

    public function test_it_updates_a_patient_guardian(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create(['full_name' => 'Siti Aminah']);

        $this->putJson("/api/v1/patient-guardians/{$guardian->id}", ['full_name' => 'Siti Aminah Wijaya'])
            ->assertOk()
            ->assertJsonPath('data.full_name', 'Siti Aminah Wijaya');
    }

    public function test_it_deletes_a_patient_guardian(): void
    {
        $this->actingUser();
        $guardian = PatientGuardian::factory()->create();

        $this->deleteJson("/api/v1/patient-guardians/{$guardian->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_guardians', ['id' => $guardian->id]);
    }

    public function test_guest_cannot_access_patient_guardians(): void
    {
        $this->getJson('/api/v1/patient-guardians')->assertStatus(401);
    }
}
