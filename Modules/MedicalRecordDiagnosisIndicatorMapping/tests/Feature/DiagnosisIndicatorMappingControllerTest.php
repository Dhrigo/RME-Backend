<?php

namespace Modules\MedicalRecordDiagnosisIndicatorMapping\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordDiagnosisIndicatorMapping\Models\DiagnosisIndicatorMapping;
use Tests\TestCase;

class DiagnosisIndicatorMappingControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_diagnosis_indicator_mapping(): void
    {
        $this->actingUser();

        $payload = [
            'diagnosis_id' => 15,
            'indicator_code' => 'IND-001',
            'indicator_name' => 'Pain Score',
            'target_score' => '<3',
            'description' => 'Target pain level',
        ];

        $response = $this->postJson('/api/v1/diagnosis-indicator-mappings', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.diagnosis_id', 15)
            ->assertJsonPath('data.indicator_code', 'IND-001');

        $this->assertDatabaseHas('diagnosis_indicator_mappings', ['diagnosis_id' => 15, 'indicator_code' => 'IND-001']);
    }

    public function test_it_lists_diagnosis_indicator_mappings(): void
    {
        $this->actingUser();
        DiagnosisIndicatorMapping::factory()->count(2)->create(['diagnosis_id' => 15]);

        $response = $this->getJson('/api/v1/diagnosis-indicator-mappings?diagnosis_id=15');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_diagnosis_indicator_mapping(): void
    {
        $this->actingUser();
        $mapping = DiagnosisIndicatorMapping::factory()->create();

        $response = $this->getJson("/api/v1/diagnosis-indicator-mappings/{$mapping->id}");

        $response->assertOk()->assertJsonPath('data.id', $mapping->id);
    }

    public function test_it_updates_a_diagnosis_indicator_mapping(): void
    {
        $this->actingUser();
        $mapping = DiagnosisIndicatorMapping::factory()->create();

        $response = $this->putJson("/api/v1/diagnosis-indicator-mappings/{$mapping->id}", [
            'indicator_name' => 'Updated Indicator',
        ]);

        $response->assertOk()->assertJsonPath('data.indicator_name', 'Updated Indicator');
    }

    public function test_it_deletes_a_diagnosis_indicator_mapping(): void
    {
        $this->actingUser();
        $mapping = DiagnosisIndicatorMapping::factory()->create();

        $response = $this->deleteJson("/api/v1/diagnosis-indicator-mappings/{$mapping->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('diagnosis_indicator_mappings', ['id' => $mapping->id]);
    }
}
