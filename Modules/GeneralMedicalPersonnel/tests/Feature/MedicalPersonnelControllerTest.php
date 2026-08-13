<?php

namespace Modules\GeneralMedicalPersonnel\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralMedicalPersonnel\Models\MedicalPersonnel;
use Tests\TestCase;

class MedicalPersonnelControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_medical_personnel(): void
    {
        $this->actingUser();
        MedicalPersonnel::factory()->count(3)->create();

        $this->getJson('/api/v1/medical-personnel')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_medical_personnel(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/medical-personnel', [
            'name' => 'Siti Nurhaliza',
            'personnel_type' => 'Apoteker',
            'license_number' => 'STR-1234567890',
        ])->assertCreated()->assertJsonPath('data.name', 'Siti Nurhaliza');

        $this->assertDatabaseHas('medical_personnel', ['name' => 'Siti Nurhaliza', 'personnel_type' => 'Apoteker']);
    }

    public function test_it_requires_personnel_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/medical-personnel', ['name' => 'Budi'])->assertStatus(422);
    }

    public function test_it_updates_medical_personnel(): void
    {
        $this->actingUser();
        $personnel = MedicalPersonnel::factory()->create(['is_active' => true]);

        $this->putJson("/api/v1/medical-personnel/{$personnel->id}", ['is_active' => false])
            ->assertOk()
            ->assertJsonPath('data.is_active', false);
    }

    public function test_it_deletes_medical_personnel(): void
    {
        $this->actingUser();
        $personnel = MedicalPersonnel::factory()->create();

        $this->deleteJson("/api/v1/medical-personnel/{$personnel->id}")->assertStatus(204);
        $this->assertDatabaseMissing('medical_personnel', ['id' => $personnel->id]);
    }
}
