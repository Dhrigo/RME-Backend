<?php

namespace Modules\GeneralRoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralRoom\Database\Factories\RoomFactory;
use Modules\GeneralRoomClass\Models\RoomClass;
use Modules\GeneralWard\Models\Ward;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'room_number', 'class_id', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function roomClass(): BelongsTo
    {
        return $this->belongsTo(RoomClass::class, 'class_id');
    }

    protected static function newFactory(): RoomFactory
    {
        return RoomFactory::new();
    }
}
