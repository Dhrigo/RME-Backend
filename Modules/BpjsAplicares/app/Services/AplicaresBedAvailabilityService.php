<?php

namespace Modules\BpjsAplicares\Services;

use Modules\GeneralBed\Models\Bed;
use Modules\GeneralRoom\Models\Room;
use Modules\PendaftaranVisit\Models\Visit;

/**
 * Reads bed occupancy from the existing GeneralBed/PendaftaranVisit modules
 * (no duplicate room/bed schema here) so BpjsAplicares can push counts to BPJS.
 * A bed counts as occupied when an active visit (discharged_at is null) is
 * currently assigned to it - GeneralBed itself has no separate occupancy flag.
 */
class AplicaresBedAvailabilityService
{
    public function counts(Room $room): array
    {
        $bedIds = Bed::query()->where('room_id', $room->id)->where('is_active', true)->pluck('id');

        $occupied = Visit::query()
            ->whereIn('bed_id', $bedIds)
            ->whereNull('discharged_at')
            ->distinct('bed_id')
            ->count('bed_id');

        return [
            'bed_count' => $bedIds->count(),
            'available_count' => max(0, $bedIds->count() - $occupied),
        ];
    }
}
