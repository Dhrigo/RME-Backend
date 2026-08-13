<?php

namespace Modules\MedicalRecordLowerGiTractExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordLowerGiTractExamination\Models\LowerGiTractExamination;
use Tests\TestCase;

class LowerGiTractExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 1,
        ];

        $response = $this->postJson('/api/v1/lower-gi-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        LowerGiTractExamination::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/lower-gi-examinations');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = LowerGiTractExamination::factory()->create();

        $response = $this->getJson("/api/v1/lower-gi-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = LowerGiTractExamination::factory()->create();

        $response = $this->putJson("/api/v1/lower-gi-examinations/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = LowerGiTractExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/lower-gi-examinations/{$record->id}");

        $response->assertNoContent();
    }
}
