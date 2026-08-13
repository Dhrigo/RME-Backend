<?php

namespace Modules\MedicalRecordNoseExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordNoseExamination\Models\NoseExamination;
use Tests\TestCase;

class NoseExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_nose_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 23,
            'deformity' => 'None',
            'septum_deviation' => true,
            'nasal_discharge' => 'Mucopurulent',
        ];

        $response = $this->postJson('/api/v1/nose-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 23)
            ->assertJsonPath('data.septum_deviation', true);

        $this->assertDatabaseHas('nose_examinations', ['visit_id' => 23, 'nasal_discharge' => 'Mucopurulent']);
    }

    public function test_it_lists_nose_examinations(): void
    {
        $this->actingUser();
        NoseExamination::factory()->count(2)->create(['visit_id' => 23]);

        $response = $this->getJson('/api/v1/nose-examinations?visit_id=23');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_nose_examination(): void
    {
        $this->actingUser();
        $record = NoseExamination::factory()->create();

        $response = $this->getJson("/api/v1/nose-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_nose_examination(): void
    {
        $this->actingUser();
        $record = NoseExamination::factory()->create();

        $response = $this->putJson("/api/v1/nose-examinations/{$record->id}", [
            'polyp_present' => true,
        ]);

        $response->assertOk()->assertJsonPath('data.polyp_present', true);
    }

    public function test_it_deletes_a_nose_examination(): void
    {
        $this->actingUser();
        $record = NoseExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/nose-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('nose_examinations', ['id' => $record->id]);
    }
}
