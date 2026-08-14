<?php

namespace Modules\BpjsAplicares\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Modules\Auth\Models\User;
use Modules\BpjsAplicares\Models\AplicaresRoomSync;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralRoom\Models\Room;
use Modules\PendaftaranVisit\Models\Visit;
use Tests\TestCase;

class AplicaresRoomControllerTest extends TestCase
{
    use RefreshDatabase;

    private function actingUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        return $user;
    }

    public function test_it_registers_a_room_with_bpjs(): void
    {
        $this->actingUser();
        $room = Room::factory()->create();

        Http::fake([
            '*/ruangan/insert' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => ['kodeRuangan' => 'RG0001'],
            ]),
        ]);

        $response = $this->postJson('/api/v1/aplicares/rooms', ['room_id' => $room->id]);

        $response->assertCreated()->assertJsonPath('data.sync_status', 'registered')->assertJsonPath('data.bpjs_room_id', 'RG0001');
        $this->assertDatabaseHas('aplicares_room_syncs', ['room_id' => $room->id, 'sync_status' => 'registered']);
    }

    public function test_it_pushes_bed_availability_counts_reading_local_bed_and_visit_data(): void
    {
        $this->actingUser();
        $room = Room::factory()->create();
        $beds = Bed::factory()->count(3)->create(['room_id' => $room->id, 'is_active' => true]);
        Visit::factory()->create(['bed_id' => $beds->first()->id, 'discharged_at' => null]);

        $sync = AplicaresRoomSync::factory()->create([
            'room_id' => $room->id,
            'bpjs_room_id' => 'RG0002',
            'sync_status' => 'registered',
        ]);

        Http::fake([
            '*/ruangan/updatetempattidur' => Http::response([
                'metaData' => ['code' => '200', 'message' => 'OK'],
                'response' => null,
            ]),
        ]);

        $response = $this->postJson("/api/v1/aplicares/rooms/{$sync->id}/beds");

        $response->assertOk()->assertJsonPath('data.bed_count', 3)->assertJsonPath('data.available_count', 2);
        $this->assertDatabaseHas('aplicares_room_syncs', ['id' => $sync->id, 'bed_count' => 3, 'available_count' => 2, 'sync_status' => 'synced']);
    }

    public function test_it_rejects_bed_update_for_unregistered_room(): void
    {
        $this->actingUser();
        $sync = AplicaresRoomSync::factory()->create(['sync_status' => 'pending']);

        $this->postJson("/api/v1/aplicares/rooms/{$sync->id}/beds")->assertStatus(422);
    }

    public function test_it_deletes_a_room_registration(): void
    {
        $this->actingUser();
        $sync = AplicaresRoomSync::factory()->create(['bpjs_room_id' => 'RG0003', 'sync_status' => 'registered']);

        Http::fake([
            '*/ruangan/delete/*' => Http::response(['metaData' => ['code' => '200', 'message' => 'OK'], 'response' => null]),
        ]);

        $this->deleteJson("/api/v1/aplicares/rooms/{$sync->id}")->assertNoContent();
        $this->assertDatabaseHas('aplicares_room_syncs', ['id' => $sync->id, 'sync_status' => 'deleted']);
    }

    public function test_guest_cannot_access_rooms(): void
    {
        $this->getJson('/api/v1/aplicares/rooms')->assertStatus(401);
    }
}
