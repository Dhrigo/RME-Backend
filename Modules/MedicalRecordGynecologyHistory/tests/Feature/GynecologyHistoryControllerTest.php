<?php

namespace Modules\MedicalRecordGynecologyHistory\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordGynecologyHistory\Models\GynecologyHistory;
use Tests\TestCase;

class GynecologyHistoryControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/gynecology-histories', [
            'visit_id' => $visit->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('gynecology_histories', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        GynecologyHistory::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/gynecology-histories');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/gynecology-histories')->assertStatus(401);
    }
}
