<?php

namespace Modules\MedicalRecordObstetricHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordObstetricHistory\Models\ObstetricHistory;
use Tests\TestCase;

class ObstetricHistoryControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/obstetric-histories', [
            'visit_id' => $visit->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('obstetric_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ObstetricHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/obstetric-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/obstetric-histories')->assertStatus(401);
    }
}
