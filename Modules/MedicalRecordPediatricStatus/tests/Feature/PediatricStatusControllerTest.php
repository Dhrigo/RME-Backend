<?php

namespace Modules\MedicalRecordPediatricStatus\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\MedicalRecordPediatricStatus\Models\PediatricStatus;
use Tests\TestCase;

class PediatricStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_pediatric_status_record(): void
    {
        $this->actingUser();
        $patient = Patient::factory()->create();
        $visit = Visit::factory()->create();

        $response = $this->postJson('/api/v1/pediatric-statuses', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
            'birth_weight_grams' => 3200,
            'birth_length_cm' => 49.5,
            'head_circumference_cm' => 34.0,
            'gestational_age_weeks' => 39,
            'immunization_status' => 'Up to date',
            'developmental_milestones' => 'Normal',
        ]);

        $response->assertCreated()->assertJsonPath('data.birth_weight_grams', 3200);
        $this->assertDatabaseHas('pediatric_statuses', [
            'patient_id' => $patient->id,
            'visit_id' => $visit->id,
        ]);
    }

    public function test_it_lists_pediatric_statuses(): void
    {
        $this->actingUser();
        $status = PediatricStatus::factory()->create();

        $response = $this->getJson('/api/v1/pediatric-statuses');

        $response->assertOk()->assertJsonCount(1, 'data');
        $this->assertEquals($status->id, $response->json('data.0.id'));
    }

    public function test_it_shows_a_pediatric_status(): void
    {
        $this->actingUser();
        $status = PediatricStatus::factory()->create();

        $response = $this->getJson("/api/v1/pediatric-statuses/{$status->id}");

        $response->assertOk()->assertJsonPath('data.id', $status->id);
    }

    public function test_it_updates_a_pediatric_status(): void
    {
        $this->actingUser();
        $status = PediatricStatus::factory()->create();

        $response = $this->putJson("/api/v1/pediatric-statuses/{$status->id}", [
            'patient_id' => $status->patient_id,
            'visit_id' => $status->visit_id,
            'notes' => 'Updated notes',
        ]);

        $response->assertOk()->assertJsonPath('data.notes', 'Updated notes');
    }

    public function test_it_deletes_a_pediatric_status(): void
    {
        $this->actingUser();
        $status = PediatricStatus::factory()->create();

        $response = $this->deleteJson("/api/v1/pediatric-statuses/{$status->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('pediatric_statuses', ['id' => $status->id]);
    }
}
