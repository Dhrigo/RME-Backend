<?php

namespace Modules\LayananPharmacyServiceTimeStage\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananPharmacyServiceTime\Models\PharmacyServiceTime;
use Modules\LayananPharmacyServiceTimeStage\Models\PharmacyServiceTimeStage;
use Tests\TestCase;

class PharmacyServiceTimeStageControllerTest extends TestCase
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
        $pharmacyServiceTimeId = PharmacyServiceTime::factory()->create();

        $response = $this->postJson('/api/v1/pharmacy-service-time-stages', [
            'pharmacy_service_time_id' => $pharmacyServiceTimeId->id,
            'stage_name' => 'Test value',
            'recorded_at' => now()->toDateTimeString(),
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('pharmacy_service_time_stages', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        PharmacyServiceTimeStage::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/pharmacy-service-time-stages');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyServiceTimeStage::factory()->create();

        $this->getJson("/api/v1/pharmacy-service-time-stages/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = PharmacyServiceTimeStage::factory()->create();

        $this->deleteJson("/api/v1/pharmacy-service-time-stages/{$record->id}")->assertStatus(204);
    }
}
