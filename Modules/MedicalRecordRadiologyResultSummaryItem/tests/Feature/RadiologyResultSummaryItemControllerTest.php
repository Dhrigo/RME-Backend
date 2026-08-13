<?php

namespace Modules\MedicalRecordRadiologyResultSummaryItem\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordRadiologyResultSummaryItem\Models\RadiologyResultSummaryItem;
use Tests\TestCase;

class RadiologyResultSummaryItemControllerTest extends TestCase
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
        $summary = \Modules\MedicalRecordRadiologyResultSummary\Models\RadiologyResultSummary::factory()->create();

        $response = $this->postJson('/api/v1/radiology-result-summary-items', [
            'summary_id' => $summary->id,
            'exam_name' => fake()->randomElement(['Thorax PA','CT Scan Kepala','USG Abdomen','MRI Lumbal']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('radiology_result_summary_items', ['summary_id' => $summary->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        RadiologyResultSummaryItem::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/radiology-result-summary-items');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/radiology-result-summary-items')->assertStatus(401);
    }
}
