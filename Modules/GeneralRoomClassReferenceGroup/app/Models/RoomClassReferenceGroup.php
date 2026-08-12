<?php

namespace Modules\GeneralRoomClassReferenceGroup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralRoomClassReferenceGroup\Database\Factories\RoomClassReferenceGroupFactory;

class RoomClassReferenceGroup extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): RoomClassReferenceGroupFactory
    {
        return RoomClassReferenceGroupFactory::new();
    }
}
