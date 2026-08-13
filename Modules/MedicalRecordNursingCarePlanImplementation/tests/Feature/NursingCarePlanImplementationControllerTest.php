<?php

namespace Modules\MedicalRecordNursingCarePlanImplementation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordNursingCarePlan\Models\NursingCarePlan;
use Modules\MedicalRecordNursingCarePlanImplementation\Models\NursingCarePlanImplementation;
use Tests\TestCase;

class NursingCarePlanImplementationControllerTest extends TestCase
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
        $nursingCarePlanId = NursingCarePlan::factory()->create();
        $performedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/nursing-care-plan-implementations', [
            'nursing_care_plan_id' => $nursingCarePlanId->id,
            'performed_by' => $performedBy->id,
            'performed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('nursing_care_plan_implementations', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        NursingCarePlanImplementation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/nursing-care-plan-implementations');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = NursingCarePlanImplementation::factory()->create();

        $this->getJson("/api/v1/nursing-care-plan-implementations/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = NursingCarePlanImplementation::factory()->create();

        $this->deleteJson("/api/v1/nursing-care-plan-implementations/{$record->id}")->assertStatus(204);
    }
}
