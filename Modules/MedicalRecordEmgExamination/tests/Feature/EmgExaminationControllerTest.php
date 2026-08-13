<?php

namespace Modules\MedicalRecordEmgExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordEmgExamination\Models\EmgExamination;
use Tests\TestCase;

class EmgExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_emg_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 18,
            'patient_id' => 36,
            'nerve_conduction_velocity' => 58.5,
            'spontaneous_activity' => 'Fibrillations',
            'conclusion' => 'Mild radiculopathy',
        ];

        $response = $this->postJson('/api/v1/emg-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.nerve_conduction_velocity', 58.5)
            ->assertJsonPath('data.spontaneous_activity', 'Fibrillations');

        $this->assertDatabaseHas('emg_examinations', ['visit_id' => 18, 'patient_id' => 36]);
    }

    public function test_it_lists_emg_examinations(): void
    {
        $this->actingUser();
        EmgExamination::factory()->count(2)->create(['visit_id' => 18]);

        $response = $this->getJson('/api/v1/emg-examinations?visit_id=18');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_emg_examination(): void
    {
        $this->actingUser();
        $record = EmgExamination::factory()->create();

        $response = $this->getJson("/api/v1/emg-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_emg_examination(): void
    {
        $this->actingUser();
        $record = EmgExamination::factory()->create();

        $response = $this->putJson("/api/v1/emg-examinations/{$record->id}", [
            'conclusion' => 'Updated EMG conclusion',
        ]);

        $response->assertOk()->assertJsonPath('data.conclusion', 'Updated EMG conclusion');
    }

    public function test_it_deletes_an_emg_examination(): void
    {
        $this->actingUser();
        $record = EmgExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/emg-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('emg_examinations', ['id' => $record->id]);
    }
}
