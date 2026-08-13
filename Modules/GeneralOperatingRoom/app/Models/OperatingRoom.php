<?php

namespace Modules\GeneralOperatingRoom\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralOperatingRoom\Database\Factories\OperatingRoomFactory;
use Modules\GeneralWard\Models\Ward;

class OperatingRoom extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'room_number', 'equipment_notes', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): OperatingRoomFactory
    {
        return OperatingRoomFactory::new();
    }
}
