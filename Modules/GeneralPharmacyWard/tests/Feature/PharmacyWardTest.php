<?php

namespace Modules\GeneralPharmacyWard\Tests\Feature;

use Tests\TestCase;
use Modules\GeneralPharmacyWard\Models\PharmacyWard;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PharmacyWardTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list()
    {
        PharmacyWard::factory()->count(3)->create();
        $response = $this->getJson('/api/pharmacy_wards');
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_can_create()
    {
        $data = PharmacyWard::factory()->make()->toArray();
        $response = $this->postJson('/api/pharmacy_wards', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('pharmacy_wards', ['name' => $data['name']]);
    }

    public function test_can_show()
    {
        $model = PharmacyWard::factory()->create();
        $response = $this->getJson("/api/pharmacy_wards/{$model->id}");
        $response->assertStatus(200)->assertJsonPath('data.name', $model->name);
    }

    public function test_can_update()
    {
        $model = PharmacyWard::factory()->create();
        $response = $this->putJson("/api/pharmacy_wards/{$model->id}", [
            'name' => 'Updated Name',
            'is_active' => true,
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('pharmacy_wards', ['name' => 'Updated Name']);
    }

    public function test_can_delete()
    {
        $model = PharmacyWard::factory()->create();
        $response = $this->deleteJson("/api/pharmacy_wards/{$model->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('pharmacy_wards', ['id' => $model->id]);
    }
}
