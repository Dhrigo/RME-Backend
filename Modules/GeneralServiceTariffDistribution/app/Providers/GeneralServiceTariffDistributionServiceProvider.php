<?php

namespace Modules\GeneralServiceTariffDistribution\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralServiceTariffDistributionServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralServiceTariffDistribution';
    protected string $nameLower = 'generalservicetariffdistribution';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
