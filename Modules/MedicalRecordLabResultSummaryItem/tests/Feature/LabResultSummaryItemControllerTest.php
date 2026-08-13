<?php

namespace Modules\MedicalRecordLabResultSummaryItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordLabResultSummaryItem\Models\LabResultSummaryItem;
use Tests\TestCase;

class LabResultSummaryItemControllerTest extends TestCase
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
        $summary = \Modules\MedicalRecordLabResultSummary\Models\LabResultSummary::factory()->create();

        $response = $this->postJson('/api/v1/lab-result-summary-items', [
            'summary_id' => $summary->id,
            'lab_test_name' => fake()->randomElement(['Hemoglobin','Leukosit','Trombosit','Kreatinin','SGOT']),
            'result_value' => (string) fake()->randomFloat(1,1,200),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('lab_result_summary_items', ['summary_id' => $summary->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        LabResultSummaryItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/lab-result-summary-items');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/lab-result-summary-items')->assertStatus(401);
    }
}
