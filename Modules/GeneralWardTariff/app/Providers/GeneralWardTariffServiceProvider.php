<?php

namespace Modules\GeneralWardTariff\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralWardTariffServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralWardTariff';
    protected string $nameLower = 'generalwardtariff';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
