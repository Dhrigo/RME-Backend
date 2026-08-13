<?php

namespace Modules\GeneralRadiologyWard\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralRadiologyWard\Models\RadiologyWard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RadiologyWardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        RadiologyWard::factory()->count(3)->create();
        $response = $this->getJson('/api/radiology_wards');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = RadiologyWard::factory()->make()->toArray();
        $response = $this->postJson('/api/radiology_wards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('radiology_wards', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = RadiologyWard::factory()->create();
        $response = $this->getJson("/api/radiology_wards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = RadiologyWard::factory()->create();
        $response = $this->putJson("/api/radiology_wards/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('radiology_wards', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = RadiologyWard::factory()->create();
        $response = $this->deleteJson("/api/radiology_wards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('radiology_wards', ['id' => $model->id]);
    }
}
