<?php

namespace Modules\MedicalRecordIntradialyticHdMonitoring\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordIntradialyticHdMonitoring\Models\IntradialyticHdMonitoring;
use Tests\TestCase;

class IntradialyticHdMonitoringControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_intradialytic_hd_monitoring_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 8,
            'patient_id' => 16,
            'dialysis_hour' => 2,
            'blood_pressure_systolic' => 130,
            'blood_pressure_diastolic' => 85,
            'blood_flow_rate' => 220,
            'dialysate_flow_rate' => 500,
            'ultrafiltration_rate' => 350,
        ];

        $response = $this->postJson('/api/v1/intradialytic-hd-monitorings', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.dialysis_hour', 2)
            ->assertJsonPath('data.blood_flow_rate', 220);

        $this->assertDatabaseHas('intradialytic_hd_monitorings', ['visit_id' => 8, 'dialysis_hour' => 2]);
    }

    public function test_it_lists_intradialytic_hd_monitorings(): void
    {
        $this->actingUser();
        IntradialyticHdMonitoring::factory()->count(2)->create(['visit_id' => 8]);

        $response = $this->getJson('/api/v1/intradialytic-hd-monitorings?visit_id=8');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_intradialytic_hd_monitoring(): void
    {
        $this->actingUser();
        $record = IntradialyticHdMonitoring::factory()->create();

        $response = $this->getJson("/api/v1/intradialytic-hd-monitorings/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_intradialytic_hd_monitoring(): void
    {
        $this->actingUser();
        $record = IntradialyticHdMonitoring::factory()->create();

        $response = $this->putJson("/api/v1/intradialytic-hd-monitorings/{$record->id}", [
            'symptoms' => 'Mild headache',
        ]);

        $response->assertOk()->assertJsonPath('data.symptoms', 'Mild headache');
    }

    public function test_it_deletes_an_intradialytic_hd_monitoring(): void
    {
        $this->actingUser();
        $record = IntradialyticHdMonitoring::factory()->create();

        $response = $this->deleteJson("/api/v1/intradialytic-hd-monitorings/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('intradialytic_hd_monitorings', ['id' => $record->id]);
    }
}
