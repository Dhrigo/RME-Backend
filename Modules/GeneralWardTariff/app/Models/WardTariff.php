<?php

namespace Modules\GeneralWardTariff\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralWardTariff\Database\Factories\WardTariffFactory;

class WardTariff extends Model
{
    use HasFactory;

    protected $fillable = ['ward_id', 'room_class_id', 'price', 'effective_date', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): WardTariffFactory
    {
        return WardTariffFactory::new();
    }
}
