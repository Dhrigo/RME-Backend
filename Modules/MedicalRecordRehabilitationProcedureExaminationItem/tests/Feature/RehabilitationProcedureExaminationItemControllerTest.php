<?php

namespace Modules\MedicalRecordRehabilitationProcedureExaminationItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordRehabilitationProcedureExamination\Models\RehabilitationProcedureExamination;
use Modules\MedicalRecordRehabilitationProcedureExaminationItem\Models\RehabilitationProcedureExaminationItem;
use Tests\TestCase;

class RehabilitationProcedureExaminationItemControllerTest extends TestCase
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
        $parent = RehabilitationProcedureExamination::factory()->create();

        $payload = [
            'rehabilitation_procedure_examination_id' => $parent->id,
            'step_name' => 'Shoulder flexion exercise',
        ];

        $response = $this->postJson('/api/v1/rehab-procedure-examination-items', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.step_name', 'Shoulder flexion exercise');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        RehabilitationProcedureExaminationItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/rehab-procedure-examination-items');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = RehabilitationProcedureExaminationItem::factory()->create();

        $response = $this->getJson("/api/v1/rehab-procedure-examination-items/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = RehabilitationProcedureExaminationItem::factory()->create();

        $response = $this->putJson("/api/v1/rehab-procedure-examination-items/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = RehabilitationProcedureExaminationItem::factory()->create();

        $response = $this->deleteJson("/api/v1/rehab-procedure-examination-items/{$record->id}");

        $response->assertNoContent();
    }
}
