<?php

namespace Modules\GeneralAudioAttachment\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralAudioAttachment\Models\AudioAttachment;
use Tests\TestCase;

class AudioAttachmentControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_lists_audio_attachments(): void
    {
        $this->actingUser();
        AudioAttachment::factory()->count(3)->create();

        $this->getJson('/api/v1/audio-attachments')->assertOk()->assertJsonCount(3, 'data');
    }

    public function test_it_creates_audio_attachment(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/audio-attachments', [
            'title' => 'Test Title',
            'file_path' => 'Test File_path',
        ])->assertCreated();

        $this->assertDatabaseCount('audio_attachments', 1);
    }

    public function test_it_deletes_audio_attachment(): void
    {
        $this->actingUser();
        $audio_attachment = AudioAttachment::factory()->create();

        $this->deleteJson("/api/v1/audio-attachments/{$audio_attachment->id}")->assertStatus(204);
        $this->assertDatabaseMissing('audio_attachments', ['id' => $audio_attachment->id]);
    }

    public function test_it_shows_audio_attachment(): void
    {
        $this->actingUser();
        $audio_attachment = AudioAttachment::factory()->create();

        $this->getJson("/api/v1/audio-attachments/{$audio_attachment->id}")->assertOk()->assertJsonPath('data.id', $audio_attachment->id);
    }

}
