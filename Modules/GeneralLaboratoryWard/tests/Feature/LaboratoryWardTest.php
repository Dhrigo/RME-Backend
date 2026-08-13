<?php

namespace Modules\GeneralLaboratoryWard\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralLaboratoryWard\Models\LaboratoryWard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LaboratoryWardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        LaboratoryWard::factory()->count(3)->create();
        $response = $this->getJson('/api/laboratory_wards');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = LaboratoryWard::factory()->make()->toArray();
        $response = $this->postJson('/api/laboratory_wards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('laboratory_wards', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = LaboratoryWard::factory()->create();
        $response = $this->getJson("/api/laboratory_wards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = LaboratoryWard::factory()->create();
        $response = $this->putJson("/api/laboratory_wards/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('laboratory_wards', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = LaboratoryWard::factory()->create();
        $response = $this->deleteJson("/api/laboratory_wards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('laboratory_wards', ['id' => $model->id]);
    }
}
