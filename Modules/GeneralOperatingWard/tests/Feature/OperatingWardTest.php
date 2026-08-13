<?php

namespace Modules\GeneralOperatingWard\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralOperatingWard\Models\OperatingWard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OperatingWardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        OperatingWard::factory()->count(3)->create();
        $response = $this->getJson('/api/operating_wards');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = OperatingWard::factory()->make()->toArray();
        $response = $this->postJson('/api/operating_wards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('operating_wards', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = OperatingWard::factory()->create();
        $response = $this->getJson("/api/operating_wards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = OperatingWard::factory()->create();
        $response = $this->putJson("/api/operating_wards/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('operating_wards', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = OperatingWard::factory()->create();
        $response = $this->deleteJson("/api/operating_wards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('operating_wards', ['id' => $model->id]);
    }
}
