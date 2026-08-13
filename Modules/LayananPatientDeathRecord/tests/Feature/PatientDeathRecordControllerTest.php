<?php

namespace Modules\LayananPatientDeathRecord\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPatientDeathRecord\Models\PatientDeathRecord;
use Tests\TestCase;

class PatientDeathRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_death_records(): void
    {
        $this->actingUser();
        PatientDeathRecord::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-death-records')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_death_record(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patient-death-records', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'died_at' => '2026-01-01 08:00:00',
        ])->assertCreated();

        $this->assertDatabaseCount('patient_death_records', 1);
    }

    public function test_it_shows_death_record(): void
    {
        $this->actingUser();
        $death_record = PatientDeathRecord::factory()->create();

        $this->getJson("/api/v1/patient-death-records/{$death_record->id}")->assertOk()->assertJsonPath('data.id', $death_record->id);
    }

}
