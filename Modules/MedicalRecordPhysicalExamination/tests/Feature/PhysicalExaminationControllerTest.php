<?php

namespace Modules\MedicalRecordPhysicalExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordPhysicalExamination\Models\PhysicalExamination;
use Tests\TestCase;

class PhysicalExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_physical_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 20,
            'general_condition' => 'Good',
            'consciousness_gcs' => 'E4V5M6',
            'head_to_toe_notes' => 'No abnormalities noted',
        ];

        $response = $this->postJson('/api/v1/physical-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.visit_id', 20)
            ->assertJsonPath('data.general_condition', 'Good');

        $this->assertDatabaseHas('physical_examinations', ['visit_id' => 20, 'general_condition' => 'Good']);
    }

    public function test_it_lists_physical_examinations(): void
    {
        $this->actingUser();
        PhysicalExamination::factory()->count(2)->create(['visit_id' => 20]);

        $response = $this->getJson('/api/v1/physical-examinations?visit_id=20');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_physical_examination(): void
    {
        $this->actingUser();
        $record = PhysicalExamination::factory()->create();

        $response = $this->getJson("/api/v1/physical-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_physical_examination(): void
    {
        $this->actingUser();
        $record = PhysicalExamination::factory()->create();

        $response = $this->putJson("/api/v1/physical-examinations/{$record->id}", [
            'general_condition' => 'Moderate',
        ]);

        $response->assertOk()->assertJsonPath('data.general_condition', 'Moderate');
    }

    public function test_it_deletes_a_physical_examination(): void
    {
        $this->actingUser();
        $record = PhysicalExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/physical-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('physical_examinations', ['id' => $record->id]);
    }
}
