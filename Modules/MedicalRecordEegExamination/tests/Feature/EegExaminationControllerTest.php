<?php

namespace Modules\MedicalRecordEegExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordEegExamination\Models\EegExamination;
use Tests\TestCase;

class EegExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_eeg_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 16,
            'patient_id' => 32,
            'background_rhythm' => 'Alpha 9 Hz',
            'epileptiform_discharges' => false,
            'conclusion' => 'Normal adult EEG',
        ];

        $response = $this->postJson('/api/v1/eeg-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.background_rhythm', 'Alpha 9 Hz')
            ->assertJsonPath('data.epileptiform_discharges', false);

        $this->assertDatabaseHas('eeg_examinations', ['visit_id' => 16, 'patient_id' => 32]);
    }

    public function test_it_lists_eeg_examinations(): void
    {
        $this->actingUser();
        EegExamination::factory()->count(2)->create(['visit_id' => 16]);

        $response = $this->getJson('/api/v1/eeg-examinations?visit_id=16');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_eeg_examination(): void
    {
        $this->actingUser();
        $record = EegExamination::factory()->create();

        $response = $this->getJson("/api/v1/eeg-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_eeg_examination(): void
    {
        $this->actingUser();
        $record = EegExamination::factory()->create();

        $response = $this->putJson("/api/v1/eeg-examinations/{$record->id}", [
            'epileptiform_discharges' => true,
            'abnormality_type' => 'Focal Spike-Wave',
        ]);

        $response->assertOk()->assertJsonPath('data.epileptiform_discharges', true);
    }

    public function test_it_deletes_an_eeg_examination(): void
    {
        $this->actingUser();
        $record = EegExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/eeg-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('eeg_examinations', ['id' => $record->id]);
    }
}
