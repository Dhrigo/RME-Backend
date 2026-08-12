<?php

namespace Modules\PendaftaranRegistration\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranRegistration\Models\Registration;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_registers_a_patient_with_auto_generated_number(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/registrations', ['patient_id' => $patient->id]);

        $response->assertCreated();
        $this->assertStringStartsWith('REG-'.now()->format('Y').'-', $response->json('data.registration_number'));
    }

    public function test_it_records_who_registered_it(): void
    {
        $user = $this->actingUser();
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/registrations', ['patient_id' => $patient->id]);

        $this->assertDatabaseHas('registrations', ['patient_id' => $patient->id, 'registered_by' => $user->id]);
    }

    public function test_it_lists_registrations_filtered_by_patient(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        Registration::factory()->count(2)->create(['patient_id' => $patient->id]);
        Registration::factory()->create();

        $response = $this->getJson("/api/v1/registrations?patient_id={$patient->id}");

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_marks_emergency_registration(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/registrations', ['patient_id' => $patient->id, 'is_emergency' => true])
            ->assertCreated()
            ->assertJsonPath('data.is_emergency', true);
    }
}
