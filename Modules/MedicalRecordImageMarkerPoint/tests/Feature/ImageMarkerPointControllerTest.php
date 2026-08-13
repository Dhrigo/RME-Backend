<?php

namespace Modules\MedicalRecordImageMarkerPoint\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordImageMarker\Models\ImageMarker;
use Modules\MedicalRecordImageMarkerPoint\Models\ImageMarkerPoint;
use Tests\TestCase;

class ImageMarkerPointControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_creates_a_record(): void
    {
        $this->actingUser();
        $parent = ImageMarker::factory()->create();

        $payload = [
            'image_marker_id' => $parent->id,
            'x_coordinate' => 120.50,
            'y_coordinate' => 80.25,
        ];

        $response = $this->postJson('/api/v1/image-marker-points', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.x_coordinate', 120.50);
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ImageMarkerPoint::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/image-marker-points');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ImageMarkerPoint::factory()->create();

        $response = $this->getJson("/api/v1/image-marker-points/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = ImageMarkerPoint::factory()->create();

        $response = $this->putJson("/api/v1/image-marker-points/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ImageMarkerPoint::factory()->create();

        $response = $this->deleteJson("/api/v1/image-marker-points/{$record->id}");

        $response->assertNoContent();
    }
}
