<?php

namespace Modules\BpjsSmartClaim\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;

class BpjsSmartClaimServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'BpjsSmartClaim';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'bpjssmartclaim';

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
