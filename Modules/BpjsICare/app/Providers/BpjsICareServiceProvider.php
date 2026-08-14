<?php

namespace Modules\BpjsICare\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class BpjsICareServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'BpjsICare';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'bpjsicare';

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];
}
