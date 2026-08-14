<?php

namespace Modules\SatuSehatRawatInap\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatRawatInapServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatRawatInap';

    protected string $nameLower = 'satusehatrawatinap';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
