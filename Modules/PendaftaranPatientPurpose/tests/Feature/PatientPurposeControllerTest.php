<?php

namespace Modules\PendaftaranPatientPurpose\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\PendaftaranPatientPurpose\Models\PatientPurpose;
use Tests\TestCase;

class PatientPurposeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_patient_purposes(): void
    {
        $this->actingUser();
        PatientPurpose::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-purposes')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_patient_purpose(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patient-purposes', ['name' => 'Rawat Inap', 'code' => 'RI'])
            ->assertCreated()
            ->assertJsonPath('name', 'Rawat Inap');

        $this->assertDatabaseHas('patient_purposes', ['name' => 'Rawat Inap']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        PatientPurpose::factory()->create(['name' => 'Rawat Inap']);

        $this->postJson('/api/v1/patient-purposes', ['name' => 'Rawat Inap'])->assertStatus(422);
    }

    public function test_it_updates_patient_purpose(): void
    {
        $this->actingUser();
        $purpose = PatientPurpose::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/patient-purposes/{$purpose->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('is_active', false);
    }

    public function test_it_deletes_patient_purpose(): void
    {
        $this->actingUser();
        $purpose = PatientPurpose::factory()->create();

        $this->deleteJson("/api/v1/patient-purposes/{$purpose->id}")->assertStatus(204);
        $this->assertDatabaseMissing('patient_purposes', ['id' => $purpose->id]);
    }

    public function test_guest_cannot_access_patient_purposes(): void
    {
        $this->getJson('/api/v1/patient-purposes')->assertStatus(401);
    }
}