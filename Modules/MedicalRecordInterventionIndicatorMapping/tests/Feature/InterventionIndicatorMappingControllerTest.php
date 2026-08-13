<?php

namespace Modules\MedicalRecordInterventionIndicatorMapping\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInterventionIndicatorMapping\Models\InterventionIndicatorMapping;
use Tests\TestCase;

class InterventionIndicatorMappingControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_an_intervention_indicator_mapping(): void
    {
        $this->actingUser();

        $payload = [
            'intervention_code' => 'INT-101',
            'intervention_name' => 'Oxygen Therapy',
            'indicator_code' => 'IND-202',
            'indicator_name' => 'SpO2 Level',
            'evaluation_criteria' => 'SpO2 > 95%',
        ];

        $response = $this->postJson('/api/v1/intervention-indicator-mappings', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.intervention_code', 'INT-101')
            ->assertJsonPath('data.indicator_code', 'IND-202');

        $this->assertDatabaseHas('intervention_indicator_mappings', ['intervention_code' => 'INT-101']);
    }

    public function test_it_lists_intervention_indicator_mappings(): void
    {
        $this->actingUser();
        InterventionIndicatorMapping::factory()->count(2)->create(['intervention_code' => 'INT-101']);

        $response = $this->getJson('/api/v1/intervention-indicator-mappings?intervention_code=INT-101');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_an_intervention_indicator_mapping(): void
    {
        $this->actingUser();
        $mapping = InterventionIndicatorMapping::factory()->create();

        $response = $this->getJson("/api/v1/intervention-indicator-mappings/{$mapping->id}");

        $response->assertOk()->assertJsonPath('data.id', $mapping->id);
    }

    public function test_it_updates_an_intervention_indicator_mapping(): void
    {
        $this->actingUser();
        $mapping = InterventionIndicatorMapping::factory()->create();

        $response = $this->putJson("/api/v1/intervention-indicator-mappings/{$mapping->id}", [
            'intervention_name' => 'Updated Intervention',
        ]);

        $response->assertOk()->assertJsonPath('data.intervention_name', 'Updated Intervention');
    }

    public function test_it_deletes_an_intervention_indicator_mapping(): void
    {
        $this->actingUser();
        $mapping = InterventionIndicatorMapping::factory()->create();

        $response = $this->deleteJson("/api/v1/intervention-indicator-mappings/{$mapping->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('intervention_indicator_mappings', ['id' => $mapping->id]);
    }
}
