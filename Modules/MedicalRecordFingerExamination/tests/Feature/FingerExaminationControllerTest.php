<?php

namespace Modules\MedicalRecordFingerExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFingerExamination\Models\FingerExamination;
use Tests\TestCase;

class FingerExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_finger_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 25,
            'hand_side' => 'right',
            'clubbing' => false,
            'cyanosis' => false,
            'range_of_motion' => 'Full',
        ];

        $response = $this->postJson('/api/v1/finger-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 25)
            ->assertJsonPath('data.hand_side', 'right');

        $this->assertDatabaseHas('finger_examinations', ['visit_id' => 25, 'hand_side' => 'right']);
    }

    public function test_it_lists_finger_examinations(): void
    {
        $this->actingUser();
        FingerExamination::factory()->count(2)->create(['visit_id' => 25]);

        $response = $this->getJson('/api/v1/finger-examinations?visit_id=25');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_finger_examination(): void
    {
        $this->actingUser();
        $record = FingerExamination::factory()->create();

        $response = $this->getJson("/api/v1/finger-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_finger_examination(): void
    {
        $this->actingUser();
        $record = FingerExamination::factory()->create();

        $response = $this->putJson("/api/v1/finger-examinations/{$record->id}", [
            'clubbing' => true,
        ]);

        $response->assertOk()->assertJsonPath('data.clubbing', true);
    }

    public function test_it_deletes_a_finger_examination(): void
    {
        $this->actingUser();
        $record = FingerExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/finger-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('finger_examinations', ['id' => $record->id]);
    }
}
