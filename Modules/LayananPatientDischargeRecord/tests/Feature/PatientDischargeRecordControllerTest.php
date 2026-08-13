<?php

namespace Modules\LayananPatientDischargeRecord\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\LayananPatientDischargeRecord\Models\PatientDischargeRecord;
use Tests\TestCase;

class PatientDischargeRecordControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_discharge_records(): void
    {
        $this->actingUser();
        PatientDischargeRecord::factory()->count(3)->create();

        $this->getJson('/api/v1/patient-discharge-records')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_discharge_record(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/patient-discharge-records', [
            'visit_id' => \Modules\PendaftaranVisit\Models\Visit::factory()->create()->id,
            'patient_id' => \Modules\GeneralPatient\Models\Patient::factory()->create()->id,
            'discharged_at' => '2026-01-01 08:00:00',
            'discharge_method' => 'healed',
        ])->assertCreated();

        $this->assertDatabaseCount('patient_discharge_records', 1);
    }

    public function test_it_shows_discharge_record(): void
    {
        $this->actingUser();
        $discharge_record = PatientDischargeRecord::factory()->create();

        $this->getJson("/api/v1/patient-discharge-records/{$discharge_record->id}")->assertOk()->assertJsonPath('data.id', $discharge_record->id);
    }

}
