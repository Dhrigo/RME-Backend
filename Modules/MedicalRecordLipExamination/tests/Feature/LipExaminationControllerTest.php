<?php

namespace Modules\MedicalRecordLipExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordLipExamination\Models\LipExamination;
use Tests\TestCase;

class LipExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_lip_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 13,
            'color' => 'Pink',
            'symmetry' => 'Symmetrical',
            'moisture' => 'Normal',
        ];

        $response = $this->postJson('/api/v1/lip-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 13)
            ->assertJsonPath('data.color', 'Pink');

        $this->assertDatabaseHas('lip_examinations', ['visit_id' => 13, 'color' => 'Pink']);
    }

    public function test_it_lists_lip_examinations(): void
    {
        $this->actingUser();
        LipExamination::factory()->count(2)->create(['visit_id' => 13]);

        $response = $this->getJson('/api/v1/lip-examinations?visit_id=13');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_lip_examination(): void
    {
        $this->actingUser();
        $record = LipExamination::factory()->create();

        $response = $this->getJson("/api/v1/lip-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_lip_examination(): void
    {
        $this->actingUser();
        $record = LipExamination::factory()->create();

        $response = $this->putJson("/api/v1/lip-examinations/{$record->id}", [
            'moisture' => 'Dry',
        ]);

        $response->assertOk()->assertJsonPath('data.moisture', 'Dry');
    }

    public function test_it_deletes_a_lip_examination(): void
    {
        $this->actingUser();
        $record = LipExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/lip-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('lip_examinations', ['id' => $record->id]);
    }
}
