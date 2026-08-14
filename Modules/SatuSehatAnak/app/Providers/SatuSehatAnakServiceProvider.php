<?php

namespace Modules\SatuSehatAnak\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatAnakServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatAnak';

    protected string $nameLower = 'satusehatanak';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
