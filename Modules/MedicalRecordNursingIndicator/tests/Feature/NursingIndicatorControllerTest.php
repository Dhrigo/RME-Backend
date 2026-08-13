<?php

namespace Modules\MedicalRecordNursingIndicator\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordNursingIndicatorType\Models\NursingIndicatorType;
use Modules\MedicalRecordNursingIndicator\Models\NursingIndicator;
use Tests\TestCase;

class NursingIndicatorControllerTest extends TestCase
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


        $response = $this->postJson('/api/v1/nursing-indicators', [
            'name' => 'Test value',
        ]);

        $response->assertCreated();
        $this->assertDatabaseCount('nursing_indicators', 1);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        NursingIndicator::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/nursing-indicators');

        $response->assertOk();
        $this->assertCount(2, $response->json('data'));
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = NursingIndicator::factory()->create();

        $this->getJson("/api/v1/nursing-indicators/{$record->id}")->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = NursingIndicator::factory()->create();

        $this->deleteJson("/api/v1/nursing-indicators/{$record->id}")->assertStatus(204);
    }
}
