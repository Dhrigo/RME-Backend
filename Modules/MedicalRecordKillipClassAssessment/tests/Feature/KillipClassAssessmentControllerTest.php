<?php

namespace Modules\MedicalRecordKillipClassAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordKillipClassAssessment\Models\KillipClassAssessment;
use Tests\TestCase;

class KillipClassAssessmentControllerTest extends TestCase
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
        $visit = \Modules\PendaftaranVisit\Models\Visit::factory()->create();
        $assessedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/killip-class-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'killip_class' => fake()->numberBetween(1,4),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('killip_class_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        KillipClassAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/killip-class-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/killip-class-assessments')->assertStatus(401);
    }
}
