<?php

namespace Modules\MedicalRecordBloodTransfusionObservation\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBloodTransfusionObservation\Models\BloodTransfusionObservation;
use Tests\TestCase;

class BloodTransfusionObservationControllerTest extends TestCase
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

        $payload = [
            'blood_transfusion_id' => 1,
            'observed_at' => now()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/v1/blood-transfusion-observations', $payload);

        $response->assertCreated();
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BloodTransfusionObservation::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/blood-transfusion-observations');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = BloodTransfusionObservation::factory()->create();

        $response = $this->getJson("/api/v1/blood-transfusion-observations/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = BloodTransfusionObservation::factory()->create();

        $response = $this->putJson("/api/v1/blood-transfusion-observations/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = BloodTransfusionObservation::factory()->create();

        $response = $this->deleteJson("/api/v1/blood-transfusion-observations/{$record->id}");

        $response->assertNoContent();
    }
}
