<?php

namespace Modules\MedicalRecordInterventionProtocol\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordInterventionProtocol\Models\InterventionProtocol;
use Tests\TestCase;

class InterventionProtocolControllerTest extends TestCase
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
        $startedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/intervention-protocols', [
            'visit_id' => $visit->id,
            'started_by' => $startedBy->id,
            'protocol_name' => fake()->words(3,true),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('intervention_protocols', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        InterventionProtocol::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/intervention-protocols');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/intervention-protocols')->assertStatus(401);
    }
}
