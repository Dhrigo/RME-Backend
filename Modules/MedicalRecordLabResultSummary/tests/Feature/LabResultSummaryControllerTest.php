<?php

namespace Modules\MedicalRecordLabResultSummary\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordLabResultSummary\Models\LabResultSummary;
use Tests\TestCase;

class LabResultSummaryControllerTest extends TestCase
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
        $summarizedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/lab-result-summaries', [
            'visit_id' => $visit->id,
            'summarized_by' => $summarizedBy->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('lab_result_summaries', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        LabResultSummary::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/lab-result-summaries');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/lab-result-summaries')->assertStatus(401);
    }
}
