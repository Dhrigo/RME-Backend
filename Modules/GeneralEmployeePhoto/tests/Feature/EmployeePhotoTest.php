<?php

namespace Modules\GeneralEmployeePhoto\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralEmployeePhoto\Models\EmployeePhoto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeePhotoTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        EmployeePhoto::factory()->count(3)->create();
        $response = $this->getJson('/api/employee_photos');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = EmployeePhoto::factory()->make()->toArray();
        $response = $this->postJson('/api/employee_photos', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('employee_photos', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = EmployeePhoto::factory()->create();
        $response = $this->getJson("/api/employee_photos/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = EmployeePhoto::factory()->create();
        $response = $this->putJson("/api/employee_photos/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('employee_photos', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = EmployeePhoto::factory()->create();
        $response = $this->deleteJson("/api/employee_photos/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('employee_photos', ['id' => $model->id]);
    }
}
