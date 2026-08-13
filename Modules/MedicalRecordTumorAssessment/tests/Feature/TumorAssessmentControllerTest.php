<?php

namespace Modules\MedicalRecordTumorAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordTumorAssessment\Models\TumorAssessment;
use Tests\TestCase;

class TumorAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/tumor-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
            'tumor_location' => fake()->words(2,true),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tumor_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TumorAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/tumor-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/tumor-assessments')->assertStatus(401);
    }
}
