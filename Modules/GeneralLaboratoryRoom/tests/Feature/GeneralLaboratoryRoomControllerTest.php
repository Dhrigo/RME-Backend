<?php

namespace Modules\GeneralLaboratoryRoom\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Auth\Models\User;
use Modules\GeneralLaboratoryRoom\Models\LaboratoryRoom;
use Modules\GeneralWard\Models\Ward;
use Tests\TestCase;

class GeneralLaboratoryRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): void
    {
        $this->actingAs(User::factory()->create(), 'sanctum');
    }

    public function test_it_creates_laboratory_room_under_a_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();

        $this->postJson('/api/v1/laboratory-rooms', [
            'ward_id' => $ward->id,
            'lab_type' => 'patologi_klinik',
        ])
            ->assertCreated()
            ->assertJsonPath('lab_type', 'patologi_klinik');
    }

    public function test_it_lists_laboratory_rooms_filtered_by_ward(): void
    {
        $this->actingUser();
        $ward = Ward::factory()->create();
        LaboratoryRoom::factory()->count(2)->create(['ward_id' => $ward->id]);
        LaboratoryRoom::factory()->create();

        $this->getJson("/api/v1/laboratory-rooms?ward_id={$ward->id}")
            ->assertOk()
            ->assertJsonCount(2, 'data');
    }

    public function test_it_validates_store_request(): void
    {
        $this->actingUser();

        $this->postJson('/api/v1/laboratory-rooms', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['ward_id', 'lab_type']);
    }

    public function test_it_updates_laboratory_room(): void
    {
        $this->actingUser();
        $room = LaboratoryRoom::factory()->create(['lab_type' => 'mikrobiologi']);

        $this->putJson("/api/v1/laboratory-rooms/{$room->id}", ['lab_type' => 'patologi_anatomi'])
            ->assertOk()
            ->assertJsonPath('lab_type', 'patologi_anatomi');
    }

    public function test_it_deletes_laboratory_room(): void
    {
        $this->actingUser();
        $room = LaboratoryRoom::factory()->create();

        $this->deleteJson("/api/v1/laboratory-rooms/{$room->id}")
            ->assertNoContent();

        $this->assertDatabaseMissing('laboratory_rooms', ['id' => $room->id]);
    }
}
