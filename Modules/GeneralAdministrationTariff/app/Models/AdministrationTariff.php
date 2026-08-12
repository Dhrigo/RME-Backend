<?php

namespace Modules\GeneralAdministrationTariff\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralAdministrationTariff\Database\Factories\AdministrationTariffFactory;

class AdministrationTariff extends Model
{
    use HasFactory;

    protected $fillable = ['administration_id', 'room_class_id', 'price', 'effective_date', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): AdministrationTariffFactory
    {
        return AdministrationTariffFactory::new();
    }
}
