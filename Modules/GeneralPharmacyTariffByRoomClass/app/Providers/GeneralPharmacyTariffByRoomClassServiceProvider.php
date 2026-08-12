<?php

namespace Modules\GeneralPharmacyTariffByRoomClass\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralPharmacyTariffByRoomClassServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralPharmacyTariffByRoomClass';
    protected string $nameLower = 'generalpharmacytariffbyroomclass';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
