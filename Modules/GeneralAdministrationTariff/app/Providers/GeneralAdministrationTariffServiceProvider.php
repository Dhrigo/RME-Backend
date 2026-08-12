<?php

namespace Modules\GeneralAdministrationTariff\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralAdministrationTariffServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralAdministrationTariff';
    protected string $nameLower = 'generaladministrationtariff';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
