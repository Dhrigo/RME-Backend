<?php

namespace Modules\MedicalRecordFamilyPlanningObstetrics\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFamilyPlanningObstetrics\Models\FamilyPlanningObstetrics;
use Tests\TestCase;

class FamilyPlanningObstetricsControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_family_planning_obstetrics_record(): void
    {
        $this->actingUser();

        $payload = [
            'visit_id' => 7,
            'patient_id' => 14,
            'contraceptive_method' => 'IUD',
            'installation_date' => '2026-08-01',
            'side_effects' => 'Mild cramping',
        ];

        $response = $this->postJson('/api/v1/family-planning-obstetrics', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.contraceptive_method', 'IUD');

        $this->assertDatabaseHas('family_planning_obstetrics', ['visit_id' => 7, 'contraceptive_method' => 'IUD']);
    }

    public function test_it_lists_family_planning_obstetrics_records(): void
    {
        $this->actingUser();
        FamilyPlanningObstetrics::factory()->count(2)->create(['visit_id' => 7]);

        $response = $this->getJson('/api/v1/family-planning-obstetrics?visit_id=7');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_family_planning_obstetrics_record(): void
    {
        $this->actingUser();
        $record = FamilyPlanningObstetrics::factory()->create();

        $response = $this->getJson("/api/v1/family-planning-obstetrics/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_family_planning_obstetrics_record(): void
    {
        $this->actingUser();
        $record = FamilyPlanningObstetrics::factory()->create();

        $response = $this->putJson("/api/v1/family-planning-obstetrics/{$record->id}", [
            'side_effects' => 'None',
        ]);

        $response->assertOk()->assertJsonPath('data.side_effects', 'None');
    }

    public function test_it_deletes_a_family_planning_obstetrics_record(): void
    {
        $this->actingUser();
        $record = FamilyPlanningObstetrics::factory()->create();

        $response = $this->deleteJson("/api/v1/family-planning-obstetrics/{$record->id}");

        $response->assertNoContent();
        $this->assertSoftDeleted('family_planning_obstetrics', ['id' => $record->id]);
    }
}
