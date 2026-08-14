<?php

namespace Modules\SatuSehatIbuAnak\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatIbuAnakServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatIbuAnak';

    protected string $nameLower = 'satusehatibuanak';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
