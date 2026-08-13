<?php

namespace Modules\MedicalRecordImageMarker\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\MedicalRecordImageMarker\Models\ImageMarker;
use Tests\TestCase;

class ImageMarkerControllerTest extends TestCase
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

        $payload = [
            'visit_id' => 1,
            'image_path' => 'anatomy-templates/body-diagram.png',
        ];

        $response = $this->postJson('/api/v1/image-markers', $payload);

        $response->assertCreated()
            ->assertJsonPath('data.image_path', 'anatomy-templates/body-diagram.png');
    }

    public function test_it_lists_records(): void
    {
        $this->actingUser();
        ImageMarker::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/image-markers');

        $response->assertOk()->assertJsonCount(2, 'data');
    }

    public function test_it_shows_a_record(): void
    {
        $this->actingUser();
        $record = ImageMarker::factory()->create();

        $response = $this->getJson("/api/v1/image-markers/{$record->id}");

        $response->assertOk()->assertJsonPath('data.id', $record->id);
    }

    public function test_it_updates_a_record(): void
    {
        $this->actingUser();
        $record = ImageMarker::factory()->create();

        $response = $this->putJson("/api/v1/image-markers/{$record->id}", []);

        $response->assertOk();
    }

    public function test_it_deletes_a_record(): void
    {
        $this->actingUser();
        $record = ImageMarker::factory()->create();

        $response = $this->deleteJson("/api/v1/image-markers/{$record->id}");

        $response->assertNoContent();
    }
}
