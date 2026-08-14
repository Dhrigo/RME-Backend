<?php

namespace Modules\SatuSehatKptl\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatKptlServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatKptl';

    protected string $nameLower = 'satusehatkptl';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
