<?php

namespace Modules\MedicalRecordPharynxExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPharynxExamination\Models\PharynxExamination;
use Tests\TestCase;

class PharynxExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pharynx_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 19,
            'mucosa_color' => 'Hyperemic',
            'exudate' => true,
            'post_nasal_drip' => false,
            'posterior_wall_condition' => 'Granular',
        ];

        $response = $this->postJson('/api/v1/pharynx-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.mucosa_color', 'Hyperemic')
            ->assertJsonPath('data.exudate', true);

        $this->assertDatabaseHas('pharynx_examinations', ['visit_id' => 19, 'mucosa_color' => 'Hyperemic']);
    }

    public function test_it_lists_pharynx_examinations(): void
    {
        $this->actingUser();
        PharynxExamination::factory()->count(2)->create(['visit_id' => 19]);

        $response = $this->getJson('/api/v1/pharynx-examinations?visit_id=19');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_pharynx_examination(): void
    {
        $this->actingUser();
        $record = PharynxExamination::factory()->create();

        $response = $this->getJson("/api/v1/pharynx-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_pharynx_examination(): void
    {
        $this->actingUser();
        $record = PharynxExamination::factory()->create();

        $response = $this->putJson("/api/v1/pharynx-examinations/{$record->id}", [
            'mucosa_color' => 'Normal Pink',
        ]);

        $response->assertOk()->assertJsonPath('data.mucosa_color', 'Normal Pink');
    }

    public function test_it_deletes_a_pharynx_examination(): void
    {
        $this->actingUser();
        $record = PharynxExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/pharynx-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('pharynx_examinations', ['id' => $record->id]);
    }
}
