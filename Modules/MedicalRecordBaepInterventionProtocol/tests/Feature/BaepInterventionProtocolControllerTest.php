<?php

namespace Modules\MedicalRecordBaepInterventionProtocol\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBaepInterventionProtocol\Models\BaepInterventionProtocol;
use Tests\TestCase;

class BaepInterventionProtocolControllerTest extends TestCase
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
        $performedBy = \Modules\GeneralEmployee\Models\Employee::factory()->create();

        $response = $this->postJson('/api/v1/baep-intervention-protocols', [
            'visit_id' => $visit->id,
            'performed_by' => $performedBy->id,
            'stimulation_ear' => fake()->randomElement(['left','right','bilateral']),
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('baep_intervention_protocols', ['visit_id' => $visit->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BaepInterventionProtocol::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/baep-intervention-protocols');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/baep-intervention-protocols')->assertStatus(401);
    }
}
