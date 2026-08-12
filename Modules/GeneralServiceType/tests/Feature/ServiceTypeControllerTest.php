<?php

namespace Modules\GeneralServiceType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralServiceType\Models\ServiceType;
use Tests\TestCase;

class ServiceTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_service_types(): void
    {
        $this->actingUser();
        ServiceType::factory()->count(3)->create();

        $this->getJson('/api/v1/service-types')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_service_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/service-types', ['name' => 'Consultation', 'code' => 'CON'])
            ->assertCreated()
            ->assertJsonPath('name', 'Consultation');

        $this->assertDatabaseHas('service_types', ['name' => 'Consultation']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        ServiceType::factory()->create(['name' => 'Consultation']);

        $this->postJson('/api/v1/service-types', ['name' => 'Consultation'])->assertStatus(422);
    }

    public function test_it_deletes_service_type(): void
    {
        $this->actingUser();
        $type = ServiceType::factory()->create();

        $this->deleteJson("/api/v1/service-types/{$type->id}")->assertStatus(204);
        $this->assertDatabaseMissing('service_types', ['id' => $type->id]);
    }
}
