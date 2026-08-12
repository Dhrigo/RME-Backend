<?php

namespace Modules\GeneralOxygenTariff\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralOxygenTariffServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralOxygenTariff';
    protected string $nameLower = 'generaloxygentariff';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
