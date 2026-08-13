<?php

namespace Modules\GeneralLabServiceGroup\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralLabServiceGroup\Models\LabServiceGroup;
use Tests\TestCase;

class LabServiceGroupControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_lab_service_groups(): void
    {
        $this->actingUser();
        LabServiceGroup::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-service-groups')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lab_service_group(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/lab-service-groups', ['name' => 'Kimia Klinik', 'code' => 'KK'])
            ->assertCreated()
            ->assertJsonPath('name', 'Kimia Klinik');

        $this->assertDatabaseHas('lab_service_groups', ['name' => 'Kimia Klinik']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        LabServiceGroup::factory()->create(['name' => 'Kimia Klinik']);

        $this->postJson('/api/v1/lab-service-groups', ['name' => 'Kimia Klinik'])->assertStatus(422);
    }

    public function test_it_deletes_lab_service_group(): void
    {
        $this->actingUser();
        $labServiceGroup = LabServiceGroup::factory()->create();

        $this->deleteJson("/api/v1/lab-service-groups/{$labServiceGroup->id}")->assertStatus(204);
        $this->assertDatabaseMissing('lab_service_groups', ['id' => $labServiceGroup->id]);
    }
}
