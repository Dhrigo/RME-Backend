<?php

namespace Modules\MedicalRecordAnalExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordAnalExamination\Models\AnalExamination;
use Tests\TestCase;

class AnalExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_anal_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 11,
            'inspection' => 'No fissure or hemorrhoid',
            'palpation' => 'Normal tone',
            'sphincter_tone' => 'Normal',
        ];

        $response = $this->postJson('/api/v1/anal-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 11)
            ->assertJsonPath('data.sphincter_tone', 'Normal');

        $this->assertDatabaseHas('anal_examinations', ['visit_id' => 11, 'sphincter_tone' => 'Normal']);
    }

    public function test_it_lists_anal_examinations(): void
    {
        $this->actingUser();
        AnalExamination::factory()->count(2)->create(['visit_id' => 11]);

        $response = $this->getJson('/api/v1/anal-examinations?visit_id=11');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_anal_examination(): void
    {
        $this->actingUser();
        $record = AnalExamination::factory()->create();

        $response = $this->getJson("/api/v1/anal-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_anal_examination(): void
    {
        $this->actingUser();
        $record = AnalExamination::factory()->create();

        $response = $this->putJson("/api/v1/anal-examinations/{$record->id}", [
            'findings' => 'Updated findings',
        ]);

        $response->assertOk()->assertJsonPath('data.findings', 'Updated findings');
    }

    public function test_it_deletes_an_anal_examination(): void
    {
        $this->actingUser();
        $record = AnalExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/anal-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('anal_examinations', ['id' => $record->id]);
    }
}
