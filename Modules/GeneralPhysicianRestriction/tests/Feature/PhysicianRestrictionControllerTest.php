<?php

namespace Modules\GeneralPhysicianRestriction\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralDoctor\Models\Doctor;
use Modules\GeneralPhysicianRestriction\Models\PhysicianRestriction;
use Tests\TestCase;

class PhysicianRestrictionControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_restrictions(): void
    {
        $this->actingUser();
        PhysicianRestriction::factory()->count(3)->create();

        $this->getJson('/api/v1/physician-restrictions')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_restriction(): void
    {
        $this->actingUser();
        $doctor = Doctor::factory()->create();

        $this->postJson('/api/v1/physician-restrictions', [
            'doctor_id' => $doctor->id,
            'restricted_antibiotic_name' => 'Meropenem',
            'authorization_level' => 'tim_ppra',
        ])->assertCreated()->assertJsonPath('data.authorization_level', 'tim_ppra');

        $this->assertDatabaseHas('physician_restrictions', ['doctor_id' => $doctor->id, 'restricted_antibiotic_name' => 'Meropenem']);
    }

    public function test_it_rejects_invalid_authorization_level(): void
    {
        $this->actingUser();
        $doctor = Doctor::factory()->create();

        $this->postJson('/api/v1/physician-restrictions', [
            'doctor_id' => $doctor->id,
            'restricted_antibiotic_name' => 'Meropenem',
            'authorization_level' => 'invalid',
        ])->assertStatus(422);
    }

    public function test_it_updates_restriction(): void
    {
        $this->actingUser();
        $restriction = PhysicianRestriction::factory()->create(['is_authorized_prescriber' => false]);

        $this->putJson("/api/v1/physician-restrictions/{$restriction->id}", ['is_authorized_prescriber' => true])
            ->assertOk()
            ->assertJsonPath('data.is_authorized_prescriber', true);
    }

    public function test_it_deletes_restriction(): void
    {
        $this->actingUser();
        $restriction = PhysicianRestriction::factory()->create();

        $this->deleteJson("/api/v1/physician-restrictions/{$restriction->id}")->assertStatus(204);
        $this->assertDatabaseMissing('physician_restrictions', ['id' => $restriction->id]);
    }
}
