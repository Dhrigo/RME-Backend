<?php

namespace Modules\SatuSehatPtmRegistry\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatPtmRegistryServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatPtmRegistry';

    protected string $nameLower = 'satusehatptmregistry';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
