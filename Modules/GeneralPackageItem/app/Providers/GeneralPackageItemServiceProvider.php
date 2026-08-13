<?php

namespace Modules\GeneralPackageItem\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralPackageItemServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralPackageItem';
    protected string $nameLower = 'generalpackageitem';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
