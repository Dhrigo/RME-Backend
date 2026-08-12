<?php

namespace Modules\GeneralWardVisitType\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralWardVisitType\Models\WardVisitType;
use Tests\TestCase;

class WardVisitTypeControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_ward_visit_types(): void
    {
        $this->actingUser();
        WardVisitType::factory()->count(3)->create();

        $this->getJson('/api/v1/ward-visit-types')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_ward_visit_type(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/ward-visit-types', ['name' => 'Rawat Inap', 'code' => 'RI'])
            ->assertCreated()
            ->assertJsonPath('name', 'Rawat Inap');

        $this->assertDatabaseHas('ward_visit_types', ['name' => 'Rawat Inap']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        WardVisitType::factory()->create(['name' => 'Rawat Inap']);

        $this->postJson('/api/v1/ward-visit-types', ['name' => 'Rawat Inap'])->assertStatus(422);
    }

    public function test_it_deletes_ward_visit_type(): void
    {
        $this->actingUser();
        $type = WardVisitType::factory()->create();

        $this->deleteJson("/api/v1/ward-visit-types/{$type->id}")->assertStatus(204);
        $this->assertDatabaseMissing('ward_visit_types', ['id' => $type->id]);
    }
}
