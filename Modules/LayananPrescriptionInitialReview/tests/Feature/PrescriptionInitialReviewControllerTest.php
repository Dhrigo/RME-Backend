<?php

namespace Modules\LayananPrescriptionInitialReview\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionInitialReview\Models\PrescriptionInitialReview;
use Tests\TestCase;

class PrescriptionInitialReviewControllerTest extends TestCase
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
        $prescriptionId = Prescription::factory()->create();
        $reviewedBy = Employee::factory()->create();

        $response = $this->postJson('/api/v1/prescription-initial-reviews', [
            'prescription_id' => $prescriptionId->id,
            'reviewed_by' => $reviewedBy->id,
            'reviewed_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('prescription_initial_reviews', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PrescriptionInitialReview::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/prescription-initial-reviews');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PrescriptionInitialReview::factory()->create();

        $this->getJson("/api/v1/prescription-initial-reviews/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PrescriptionInitialReview::factory()->create();

        $this->deleteJson("/api/v1/prescription-initial-reviews/{$record->id}")->assertStatus(204);
    }
}
