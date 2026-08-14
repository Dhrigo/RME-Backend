<?php

namespace Modules\SatuSehatFarmasi\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatFarmasiServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatFarmasi';

    protected string $nameLower = 'satusehatfarmasi';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
