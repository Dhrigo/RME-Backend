<?php

namespace Modules\SatuSehatMasterData\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatMasterDataServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'SatuSehatMasterData';

    protected string $nameLower = 'satusehatmasterdata';

    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
