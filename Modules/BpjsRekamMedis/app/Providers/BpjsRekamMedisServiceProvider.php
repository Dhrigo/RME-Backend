<?php

namespace Modules\BpjsRekamMedis\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class BpjsRekamMedisServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'BpjsRekamMedis';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'bpjsrekammedis';

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
