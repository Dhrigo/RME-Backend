<?php

namespace Modules\MedicalRecordBaepDepressionDetail\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBaepDepressionDetail\Models\BaepDepressionDetail;
use Tests\TestCase;

class BaepDepressionDetailControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/baep-depression-details', [
            'baep_protocol_id' => $baepProtocol->id,
            'score' => fake()->numberBetween(0,52),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('baep_depression_details', ['baep_protocol_id' => $baepProtocol->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BaepDepressionDetail::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/baep-depression-details');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/baep-depression-details')->assertStatus(401);
    }
}
