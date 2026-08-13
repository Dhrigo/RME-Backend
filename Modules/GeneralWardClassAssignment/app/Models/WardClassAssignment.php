<?php

namespace Modules\GeneralWardClassAssignment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralRoomClass\Models\RoomClass;
use Modules\GeneralWard\Models\Ward;
use Modules\GeneralWardClassAssignment\Database\Factories\WardClassAssignmentFactory;

class WardClassAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'room_class_id'];

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function roomClass(): BelongsTo
    {
        return $this->belongsTo(RoomClass::class);
    }

    protected static function newFactory(): WardClassAssignmentFactory
    {
        return WardClassAssignmentFactory::new();
    }
}
