<?php

namespace Modules\GeneralPharmacyTariffByRoomClass\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralPharmacyTariffByRoomClass\Database\Factories\PharmacyTariffByRoomClassFactory;

class PharmacyTariffByRoomClass extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'room_class_id', 'price', 'effective_date', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): PharmacyTariffByRoomClassFactory
    {
        return PharmacyTariffByRoomClassFactory::new();
    }
}
