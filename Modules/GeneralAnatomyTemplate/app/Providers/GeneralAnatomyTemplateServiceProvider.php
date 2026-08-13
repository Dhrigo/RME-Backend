<?php

namespace Modules\GeneralAnatomyTemplate\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class GeneralAnatomyTemplateServiceProvider extends ModuleServiceProvider
{
    protected string $name = 'GeneralAnatomyTemplate';
    protected string $nameLower = 'generalanatomytemplate';

    protected array $providers = [
        RouteServiceProvider::class,
    ];
}
