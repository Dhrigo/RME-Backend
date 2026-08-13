<?php

namespace Modules\GeneralWardClass\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralWardClass\Models\WardClass;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WardClassTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        WardClass::factory()->count(3)->create();
        $response = $this->getJson('/api/ward_classes');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = WardClass::factory()->make()->toArray();
        $response = $this->postJson('/api/ward_classes', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('ward_classes', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = WardClass::factory()->create();
        $response = $this->getJson("/api/ward_classes/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = WardClass::factory()->create();
        $response = $this->putJson("/api/ward_classes/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('ward_classes', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = WardClass::factory()->create();
        $response = $this->deleteJson("/api/ward_classes/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('ward_classes', ['id' => $model->id]);
    }
}
