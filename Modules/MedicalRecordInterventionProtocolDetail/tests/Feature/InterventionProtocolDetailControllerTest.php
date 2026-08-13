<?php

namespace Modules\MedicalRecordInterventionProtocolDetail\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInterventionProtocolDetail\Models\InterventionProtocolDetail;
use Tests\TestCase;

class InterventionProtocolDetailControllerTest extends TestCase
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
        $protocol = \Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol::factory()->create();
        $performedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/intervention-protocol-details', [
            'protocol_id' => $protocol->id,
            'performed_by' => $performedBy->id,
            'step_number' => fake()->numberBetween(1,10),
            'step_description' => fake()->sentence(6),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('intervention_protocol_details', ['protocol_id' => $protocol->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        InterventionProtocolDetail::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/intervention-protocol-details');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/intervention-protocol-details')->assertStatus(401);
    }
}
