<?php

namespace Modules\GeneralConsultationWard\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralConsultationWard\Models\ConsultationWard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConsultationWardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        ConsultationWard::factory()->count(3)->create();
        $response = $this->getJson('/api/consultation_wards');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = ConsultationWard::factory()->make()->toArray();
        $response = $this->postJson('/api/consultation_wards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('consultation_wards', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = ConsultationWard::factory()->create();
        $response = $this->getJson("/api/consultation_wards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = ConsultationWard::factory()->create();
        $response = $this->putJson("/api/consultation_wards/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('consultation_wards', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = ConsultationWard::factory()->create();
        $response = $this->deleteJson("/api/consultation_wards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('consultation_wards', ['id' => $model->id]);
    }
}
