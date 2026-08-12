<?php

namespace Modules\KemkesBloodType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\KemkesBloodType\Models\BloodType;
use Tests\TestCase;

class BloodTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_blood_types(): void
    {
        $this->actingUser();
        BloodType::factory()->count(2)->create();

        $this->getJson('/api/v1/blood_types')->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_creates_bloodtype(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/blood_types', ['name' => 'Sample'])
            ->assertCreated()
            ->assertJsonPath('name', 'Sample');
    }

    public function test_it_deletes_bloodtype(): void
    {
        $this->actingUser();
        $item = BloodType::factory()->create();

        $this->deleteJson("/api/v1/blood_types/{$item->id}")->assertStatus(204);
    }
}
