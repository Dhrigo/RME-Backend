<?php

namespace Modules\MedicalRecordOtherHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordOtherHistory\Models\OtherHistory;
use Tests\TestCase;

class OtherHistoryControllerTest extends TestCase
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
        $recordedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/other-histories', [
            'visit_id' => $visit->id,
            'recorded_by' => $recordedBy->id,
            'description' => fake()->sentence(8),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('other_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        OtherHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/other-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/other-histories')->assertStatus(401);
    }
}
