<?php

namespace Modules\GeneralVideoAttachment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralVideoAttachment\Models\VideoAttachment;
use Tests\TestCase;

class VideoAttachmentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_video_attachments(): void
    {
        $this->actingUser();
        VideoAttachment::factory()->count(3)->create();

        $this->getJson('/api/v1/video-attachments')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_video_attachment(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/video-attachments', [
            'title' => 'Test Title',
            'file_path' => 'Test File_path',
        ])->assertCreated();

        $this->assertDatabaseCount('video_attachments', 1);
    }

    public function test_it_deletes_video_attachment(): void
    {
        $this->actingUser();
        $video_attachment = VideoAttachment::factory()->create();

        $this->deleteJson("/api/v1/video-attachments/{$video_attachment->id}")->assertStatus(204);
        $this->assertDatabaseMissing('video_attachments', ['id' => $video_attachment->id]);
    }

    public function test_it_shows_video_attachment(): void
    {
        $this->actingUser();
        $video_attachment = VideoAttachment::factory()->create();

        $this->getJson("/api/v1/video-attachments/{$video_attachment->id}")->assertOk()->assertJsonPath('data.id', $video_attachment->id);
    }

}
