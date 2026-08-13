<?php

namespace Modules\MedicalRecordIllnessProgressionHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordIllnessProgressionHistory\Models\IllnessProgressionHistory;
use Tests\TestCase;

class IllnessProgressionHistoryControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/illness-progression-histories', [
            'visit_id' => $visit->id,
            'progression_description' => fake()->sentence(10),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('illness_progression_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        IllnessProgressionHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/illness-progression-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/illness-progression-histories')->assertStatus(401);
    }
}
