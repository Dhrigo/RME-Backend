<?php

namespace Modules\GeneralPatientAccessLock\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientAccessLock\Models\PatientAccessLock;
use Tests\TestCase;

class PatientAccessLockControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_locks(): void
    {
        $this->actingUser();
        PatientAccessLock::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-access-locks')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lock_with_default_locked_at(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $response = $this->postJson('/api/v1/patient-access-locks', [
            'patient_id' => $patient->id,
            'reason' => 'Sengketa hak asuh anak',
        ]);

        $response->assertCreated()->assertJsonPath('data.reason', 'Sengketa hak asuh anak');
        $this->assertNotNull($response->json('data.locked_at'));
        $this->assertDatabaseHas('patient_access_locks', ['patient_id' => $patient->id]);
    }

    public function test_it_requires_reason(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();

        $this->postJson('/api/v1/patient-access-locks', ['patient_id' => $patient->id])
            ->assertStatus(422);
    }

    public function test_it_unlocks_a_patient(): void
    {
        $this->actingUser();
        $lock = PatientAccessLock::factory()->create(['is_active' => true, 'unlocked_at' => null]);

        $this->putJson("/api/v1/patient-access-locks/{$lock->id}", [
            'unlocked_at' => now()->toIso8601String(),
            'is_active' => false,
        ])->assertOk()->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_lock(): void
    {
        $this->actingUser();
        $lock = PatientAccessLock::factory()->create();

        $this->deleteJson("/api/v1/patient-access-locks/{$lock->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_access_locks', ['id' => $lock->id]);
    }
}
