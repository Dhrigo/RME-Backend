<?php

namespace Modules\SatuSehatRawatJalan\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class SatuSehatRawatJalanServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'SatuSehatRawatJalan';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'satusehatrawatjalan';

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
