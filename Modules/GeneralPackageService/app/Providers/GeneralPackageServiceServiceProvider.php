<?php

namespace Modules\GeneralPackageService\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralPackageServiceServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralPackageService';
    protected string $nameLower = 'generalpackageservice';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
