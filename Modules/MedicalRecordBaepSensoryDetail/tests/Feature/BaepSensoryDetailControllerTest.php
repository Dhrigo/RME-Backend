<?php

namespace Modules\MedicalRecordBaepSensoryDetail\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBaepSensoryDetail\Models\BaepSensoryDetail;
use Tests\TestCase;

class BaepSensoryDetailControllerTest extends TestCase
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
        $baepProtocol = \Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol::factory()->create();

        $response = $this->postJson('/api/v1/baep-sensory-details', [
            'baep_protocol_id' => $baepProtocol->id,
            'sensory_modality' => fake()->randomElement(['touch','pain','vibration','proprioception']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('baep_sensory_details', ['baep_protocol_id' => $baepProtocol->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BaepSensoryDetail::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/baep-sensory-details');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/baep-sensory-details')->assertStatus(401);
    }
}
