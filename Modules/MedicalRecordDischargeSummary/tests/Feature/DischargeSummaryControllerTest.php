<?php

namespace Modules\MedicalRecordDischargeSummary\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordDischargeSummary\Models\DischargeSummary;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class DischargeSummaryControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_records_a_discharge_summary(): void
    {
        $user = $this->actingUser();
        $visit = Visit::factory()->create();
        $author = Employee::factory()->create();

        $response = $this->postJson('/api/v1/discharge-summaries', [
            'visit_id' => $visit->id,
            'authored_by' => $author->id,
            'condition_at_discharge' => 'improved',
            'follow_up_plan' => 'Kontrol 1 minggu lagi',
        ]);

        $response->assertCreated()->assertJsonPath('data.condition_at_discharge', 'improved');
        $this->assertDatabaseHas('discharge_summaries', ['visit_id' => $visit->id, 'created_by' => $user->id]);
    }

    public function test_it_lists_summaries_filtered_by_visit(): void
    {
        $this->actingUser();
        $visit = Visit::factory()->create();
        DischargeSummary::factory()->create(['visit_id' => $visit->id]);
        DischargeSummary::factory()->create();

        $response = $this->getJson("/api/v1/discharge-summaries?visit_id={$visit->id}");

        $response->assertOk()->assertJsonCount(1, 'data');
    }

    public function test_guest_cannot_access_discharge_summaries(): void
    {
        $this->getJson('/api/v1/discharge-summaries')->assertStatus(401);
    }
}
