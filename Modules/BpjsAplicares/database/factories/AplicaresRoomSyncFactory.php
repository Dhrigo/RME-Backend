<?php

namespace Modules\BpjsAplicares\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\BpjsAplicares\Models\AplicaresRoomSync;
use Modules\GeneralRoom\Models\Room;

class AplicaresRoomSyncFactory extends Factory
{
    protected $model = AplicaresRoomSync::class;

    public function definition(): array
    {
        return [
            'room_id' => Room::factory(),
            'bpjs_room_id' => null,
            'bed_count' => 0,
            'available_count' => 0,
            'sync_status' => 'pending',
            'sync_message' => null,
            'last_synced_at' => null,
        ];
    }
}
