<?php

namespace Modules\GeneralPatient\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_lists_patients(): void
    {
        $this->actingUser();
        Patient::factory()->count(3)->create();

        $this->getJson('/api/v1/patients')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_patient_with_auto_generated_medical_record_number(): void
    {
        $this->actingUser();

        $response = $this->postJson('/api/v1/patients', ['name' => 'Budi Santoso']);

        $response->assertCreated();
        $mrn = $response->json('data.medical_record_number');
        $this->assertNotEmpty($mrn);
        $this->assertStringStartsWith('RM-'.now()->format('Y').'-', $mrn);
    }

    public function test_it_creates_patient_with_explicit_medical_record_number(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patients', ['name' => 'Siti', 'medical_record_number' => 'RM-CUSTOM-001'])
            ->assertCreated()
            ->assertJsonPath('data.medical_record_number', 'RM-CUSTOM-001');
    }

    public function test_it_records_who_registered_the_patient(): void
    {
        $user = $this->actingUser();

        $this->postJson('/api/v1/patients', ['name' => 'Budi']);

        $this->assertDatabaseHas('patients', ['name' => 'Budi', 'registered_by' => $user->id]);
    }

    public function test_it_supports_unidentified_patients(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->unidentified()->create();

        $this->assertDatabaseHas('patients', ['id' => $patient->id, 'is_unidentified' => true]);
    }

    public function test_it_updates_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->putJson("/api/v1/patients/{$patient->id}", ['name' => 'Nama Baru'])
            ->assertOk()
            ->assertJsonPath('data.name', 'Nama Baru');
    }

    public function test_it_deletes_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->deleteJson("/api/v1/patients/{$patient->id}")->assertStatus(204);
    }

    public function test_guest_cannot_access_patients(): void
    {
        $this->getJson('/api/v1/patients')->assertStatus(401);
    }
}
