<?php

namespace Modules\MedicalRecordFunctionalStatusAssessment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordFunctionalStatusAssessment\Models\FunctionalStatusAssessment;
use Tests\TestCase;

class FunctionalStatusAssessmentControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/functional-status-assessments', [
            'visit_id' => $visit->id,
            'assessed_by' => $assessedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('functional_status_assessments', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        FunctionalStatusAssessment::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/functional-status-assessments');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/functional-status-assessments')->assertStatus(401);
    }
}
