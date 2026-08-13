<?php

namespace Modules\MedicalRecordTreatmentHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordTreatmentHistory\Models\TreatmentHistory;
use Tests\TestCase;

class TreatmentHistoryControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/treatment-histories', [
            'visit_id' => $visit->id,
            'treatment_description' => fake()->sentence(8),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('treatment_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        TreatmentHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/treatment-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/treatment-histories')->assertStatus(401);
    }
}
