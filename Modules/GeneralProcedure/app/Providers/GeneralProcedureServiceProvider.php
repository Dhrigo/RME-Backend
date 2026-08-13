<?php

namespace Modules\GeneralProcedure\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralProcedureServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralProcedure';
    protected string $nameLower = 'generalprocedure';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
