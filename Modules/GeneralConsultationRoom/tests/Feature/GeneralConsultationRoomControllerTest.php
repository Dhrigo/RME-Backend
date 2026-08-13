<?php

namespace Modules\GeneralConsultationRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralConsultationRoom\Models\ConsultationRoom;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class GeneralConsultationRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_consultation_room_under_a_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/consultation-rooms', [
            'ward_id' => $ward->id,
            'consultation_type' => 'umum',
        ])
            ->assertCreated()
            ->assertJsonPath('consultation_type', 'umum');
    }

    public function test_it_lists_consultation_rooms_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        ConsultationRoom::factory()->count(2)->create(['ward_id' => $ward->id]);
        ConsultationRoom::factory()->create();

        $this->getJson("/api/v1/consultation-rooms?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/consultation-rooms', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['ward_id', 'consultation_type']);
    }

    public function test_it_updates_consultation_room(): void
    {
        $this->actingUser();
        $room = ConsultationRoom::factory()->create(['consultation_type' => 'umum']);

        $this->putJson("/api/v1/consultation-rooms/{$room->id}", ['consultation_type' => 'spesialis'])
            ->assertOk()
            ->assertJsonPath('consultation_type', 'spesialis');
    }

    public function test_it_deletes_consultation_room(): void
    {
        $this->actingUser();
        $room = ConsultationRoom::factory()->create();

        $this->deleteJson("/api/v1/consultation-rooms/{$room->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('consultation_rooms', ['id' => $room->id]);
    }
}
