<?php

namespace Modules\GeneralLabServiceParameter\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralLabServiceGroup\Models\LabServiceGroup;
use Modules\GeneralLabServiceParameter\Models\LabServiceParameter;
use Tests\TestCase;

class LabServiceParameterControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_lab_service_parameters(): void
    {
        $this->actingUser();
        LabServiceParameter::factory()->count(3)->create();

        $this->getJson('/api/v1/lab-service-parameters')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_lab_service_parameter(): void
    {
        $this->actingUser();
        $group = LabServiceGroup::factory()->create();

        $this->postJson('/api/v1/lab-service-parameters', [
            'lab_service_group_id' => $group->id,
            'name' => 'Hemoglobin',
            'code' => 'HGB',
            'unit' => 'g/dL',
        ])
            ->assertCreated()
            ->assertJsonPath('name', 'Hemoglobin');

        $this->assertDatabaseHas('lab_service_parameters', ['name' => 'Hemoglobin', 'unit' => 'g/dL']);
    }

    public function test_it_rejects_duplicate_name(): void
    {
        $this->actingUser();
        LabServiceParameter::factory()->create(['name' => 'Hemoglobin']);

        $this->postJson('/api/v1/lab-service-parameters', ['name' => 'Hemoglobin'])->assertStatus(422);
    }

    public function test_it_deletes_lab_service_parameter(): void
    {
        $this->actingUser();
        $parameter = LabServiceParameter::factory()->create();

        $this->deleteJson("/api/v1/lab-service-parameters/{$parameter->id}")->assertStatus(204);
        $this->assertDatabaseMissing('lab_service_parameters', ['id' => $parameter->id]);
    }
}
