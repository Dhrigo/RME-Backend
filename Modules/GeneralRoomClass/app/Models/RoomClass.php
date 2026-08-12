<?php

namespace Modules\GeneralRoomClass\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralRoomClass\Database\Factories\RoomClassFactory;

class RoomClass extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): RoomClassFactory
    {
        return RoomClassFactory::new();
    }
}
