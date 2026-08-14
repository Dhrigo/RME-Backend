<?php

namespace Modules\SatuSehatIgd\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatIgdServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatIgd';

    protected string $nameLower = 'satusehatigd';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
