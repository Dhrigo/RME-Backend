<?php

namespace Modules\GeneralServiceTariffDistribution\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\GeneralServiceTariffDistribution\Database\Factories\ServiceTariffDistributionFactory;

class ServiceTariffDistribution extends Model
{
    use HasFactory;

    protected $fillable = ['service_tariff_id', 'component_id', 'amount', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    protected static function newFactory(): ServiceTariffDistributionFactory
    {
        return ServiceTariffDistributionFactory::new();
    }
}
