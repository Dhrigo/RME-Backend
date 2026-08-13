<?php

namespace Modules\MedicalRecordToeExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordToeExamination\Models\ToeExamination;
use Tests\TestCase;

class ToeExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_toe_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 24,
            'foot_side' => 'left',
            'ulceration' => false,
            'capillary_refill_seconds' => 2.0,
        ];

        $response = $this->postJson('/api/v1/toe-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 24)
            ->assertJsonPath('data.foot_side', 'left');

        $this->assertDatabaseHas('toe_examinations', ['visit_id' => 24, 'foot_side' => 'left']);
    }

    public function test_it_lists_toe_examinations(): void
    {
        $this->actingUser();
        ToeExamination::factory()->count(2)->create(['visit_id' => 24]);

        $response = $this->getJson('/api/v1/toe-examinations?visit_id=24');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_toe_examination(): void
    {
        $this->actingUser();
        $record = ToeExamination::factory()->create();

        $response = $this->getJson("/api/v1/toe-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_toe_examination(): void
    {
        $this->actingUser();
        $record = ToeExamination::factory()->create();

        $response = $this->putJson("/api/v1/toe-examinations/{$record->id}", [
            'ulceration' => true,
        ]);

        $response->assertOk()->assertJsonPath('data.ulceration', true);
    }

    public function test_it_deletes_a_toe_examination(): void
    {
        $this->actingUser();
        $record = ToeExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/toe-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('toe_examinations', ['id' => $record->id]);
    }
}
