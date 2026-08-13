<?php

namespace Modules\MedicalRecordPatientTransferSheet\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPatientTransferSheet\Models\PatientTransferSheet;
use Tests\TestCase;

class PatientTransferSheetControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_patient_transfer_sheet(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 10,
            'patient_id' => 20,
            'from_ward_id' => 1,
            'to_ward_id' => 2,
            'transfer_reason' => 'Condition improved',
            'patient_condition' => 'Stable',
        ];

        $response = $this->postJson('/api/v1/patient-transfer-sheets', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 10)
            ->assertJsonPath('data.transfer_reason', 'Condition improved');

        $this->assertDatabaseHas('patient_transfer_sheets', ['visit_id' => 10, 'patient_id' => 20]);
    }

    public function test_it_lists_patient_transfer_sheets(): void
    {
        $this->actingUser();
        PatientTransferSheet::factory()->count(3)->create(['visit_id' => 10]);

        $response = $this->getJson('/api/v1/patient-transfer-sheets?visit_id=10');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }

    public function test_it_shows_a_patient_transfer_sheet(): void
    {
        $this->actingUser();
        $sheet = PatientTransferSheet::factory()->create();

        $response = $this->getJson("/api/v1/patient-transfer-sheets/{$sheet->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $sheet->id);
    }

    public function test_it_updates_a_patient_transfer_sheet(): void
    {
        $this->actingUser();
        $sheet = PatientTransferSheet::factory()->create();

        $response = $this->putJson("/api/v1/patient-transfer-sheets/{$sheet->id}", [
            'patient_condition' => 'Critical',
        ]);

        $response->assertOk()
            ->assertJsonPath('data.patient_condition', 'Critical');

        $this->assertDatabaseHas('patient_transfer_sheets', ['id' => $sheet->id, 'patient_condition' => 'Critical']);
    }

    public function test_it_deletes_a_patient_transfer_sheet(): void
    {
        $this->actingUser();
        $sheet = PatientTransferSheet::factory()->create();

        $response = $this->deleteJson("/api/v1/patient-transfer-sheets/{$sheet->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('patient_transfer_sheets', ['id' => $sheet->id]);
    }

    public function test_guest_cannot_access_patient_transfer_sheets(): void
    {
        $this->getJson('/api/v1/patient-transfer-sheets')->assertStatus(401);
    }
}
