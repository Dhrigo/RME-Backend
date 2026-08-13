<?php

namespace Modules\MedicalRecordEkgExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordEkgExamination\Models\EkgExamination;
use Tests\TestCase;

class EkgExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_ekg_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 17,
            'patient_id' => 34,
            'heart_rate_bpm' => 80,
            'rhythm' => 'Sinus Rhythm',
            'conclusion' => 'Normal 12-lead EKG',
        ];

        $response = $this->postJson('/api/v1/ekg-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.heart_rate_bpm', 80)
            ->assertJsonPath('data.rhythm', 'Sinus Rhythm');

        $this->assertDatabaseHas('ekg_examinations', ['visit_id' => 17, 'heart_rate_bpm' => 80]);
    }

    public function test_it_lists_ekg_examinations(): void
    {
        $this->actingUser();
        EkgExamination::factory()->count(2)->create(['visit_id' => 17]);

        $response = $this->getJson('/api/v1/ekg-examinations?visit_id=17');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_ekg_examination(): void
    {
        $this->actingUser();
        $record = EkgExamination::factory()->create();

        $response = $this->getJson("/api/v1/ekg-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_ekg_examination(): void
    {
        $this->actingUser();
        $record = EkgExamination::factory()->create();

        $response = $this->putJson("/api/v1/ekg-examinations/{$record->id}", [
            'st_segment' => 'ST Elevation in V1-V3',
        ]);

        $response->assertOk()->assertJsonPath('data.st_segment', 'ST Elevation in V1-V3');
    }

    public function test_it_deletes_an_ekg_examination(): void
    {
        $this->actingUser();
        $record = EkgExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/ekg-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('ekg_examinations', ['id' => $record->id]);
    }
}
