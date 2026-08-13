<?php

namespace Modules\MedicalRecordChestExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordChestExamination\Models\ChestExamination;
use Tests\TestCase;

class ChestExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_chest_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 15,
            'inspection' => 'Normal shape and movement',
            'auscultation_breath_sounds' => 'Wheezing on right lower lobe',
            'auscultation_heart_sounds' => 'S1 S2 Normal',
        ];

        $response = $this->postJson('/api/v1/chest-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 15)
            ->assertJsonPath('data.auscultation_breath_sounds', 'Wheezing on right lower lobe');

        $this->assertDatabaseHas('chest_examinations', ['visit_id' => 15, 'auscultation_breath_sounds' => 'Wheezing on right lower lobe']);
    }

    public function test_it_lists_chest_examinations(): void
    {
        $this->actingUser();
        ChestExamination::factory()->count(2)->create(['visit_id' => 15]);

        $response = $this->getJson('/api/v1/chest-examinations?visit_id=15');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_chest_examination(): void
    {
        $this->actingUser();
        $record = ChestExamination::factory()->create();

        $response = $this->getJson("/api/v1/chest-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_chest_examination(): void
    {
        $this->actingUser();
        $record = ChestExamination::factory()->create();

        $response = $this->putJson("/api/v1/chest-examinations/{$record->id}", [
            'auscultation_breath_sounds' => 'Vesicular clear',
        ]);

        $response->assertOk()->assertJsonPath('data.auscultation_breath_sounds', 'Vesicular clear');
    }

    public function test_it_deletes_a_chest_examination(): void
    {
        $this->actingUser();
        $record = ChestExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/chest-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('chest_examinations', ['id' => $record->id]);
    }
}
