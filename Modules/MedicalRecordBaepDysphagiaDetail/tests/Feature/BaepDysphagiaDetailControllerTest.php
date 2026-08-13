<?php

namespace Modules\MedicalRecordBaepDysphagiaDetail\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordBaepDysphagiaDetail\Models\BaepDysphagiaDetail;
use Tests\TestCase;

class BaepDysphagiaDetailControllerTest extends TestCase
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

        $response = $this->postJson('/api/v1/baep-dysphagia-details', [
            'baep_protocol_id' => $baepProtocol->id,
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('baep_dysphagia_details', ['baep_protocol_id' => $baepProtocol->id]);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        BaepDysphagiaDetail::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/baep-dysphagia-details');

        $response->assertOk();
    }

    public function test_guest_cannot_access_records(): void
    {
        $this->getJson('/api/v1/baep-dysphagia-details')->assertStatus(401);
    }
}
