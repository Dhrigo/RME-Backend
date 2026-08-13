<?php

namespace Modules\MedicalRecordMchatAssessmentExamination\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordMchatAssessmentExamination\Models\MchatAssessmentExamination;
use Tests\TestCase;

class MchatAssessmentExaminationControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_mchat_assessment_examination_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 12,
            'patient_id' => 24,
            'total_score' => 4,
            'risk_level' => 'Medium Risk',
            'recommendation' => 'Refer to developmental pediatrician',
        ];

        $response = $this->postJson('/api/v1/mchat-assessment-examinations', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.total_score', 4)
            ->assertJsonPath('data.risk_level', 'Medium Risk');

        $this->assertDatabaseHas('mchat_assessment_examinations', ['visit_id' => 12, 'total_score' => 4]);
    }

    public function test_it_lists_mchat_assessment_examinations(): void
    {
        $this->actingUser();
        MchatAssessmentExamination::factory()->count(2)->create(['visit_id' => 12]);

        $response = $this->getJson('/api/v1/mchat-assessment-examinations?visit_id=12');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_mchat_assessment_examination(): void
    {
        $this->actingUser();
        $record = MchatAssessmentExamination::factory()->create();

        $response = $this->getJson("/api/v1/mchat-assessment-examinations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_an_mchat_assessment_examination(): void
    {
        $this->actingUser();
        $record = MchatAssessmentExamination::factory()->create();

        $response = $this->putJson("/api/v1/mchat-assessment-examinations/{$record->id}", [
            'risk_level' => 'High Risk',
        ]);

        $response->assertOk()->assertJsonPath('data.risk_level', 'High Risk');
    }

    public function test_it_deletes_an_mchat_assessment_examination(): void
    {
        $this->actingUser();
        $record = MchatAssessmentExamination::factory()->create();

        $response = $this->deleteJson("/api/v1/mchat-assessment-examinations/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('mchat_assessment_examinations', ['id' => $record->id]);
    }
}
