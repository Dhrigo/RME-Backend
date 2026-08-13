<?php

namespace Modules\GeneralOxygenTariff\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralOxygenTariff\Database\Factories\OxygenTariffFactory;

class OxygenTariff extends Model
{
    use HasFactory;

    protected $fillable = ['oxygen_id', 'room_class_id', 'price', 'effective_date', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): OxygenTariffFactory
    {
        return OxygenTariffFactory::new();
    }
}
