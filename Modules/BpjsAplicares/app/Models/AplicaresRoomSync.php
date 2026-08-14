<?php

namespace Modules\BpjsAplicares\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\BpjsAplicares\Database\Factories\AplicaresRoomSyncFactory;
use Modules\GeneralRoom\Models\Room;

class AplicaresRoomSync extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'bpjs_room_id',
        'bed_count',
        'available_count',
        'sync_status',
        'sync_message',
        'last_synced_at',
    ];

    protected function casts(): array
    {
        return [
            'last_synced_at' => 'datetime',
        ];
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    protected static function newFactory(): AplicaresRoomSyncFactory
    {
        return AplicaresRoomSyncFactory::new();
    }
}
