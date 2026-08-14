<?php

namespace Modules\SystemLicenseGuard\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\SystemLicenseGuard\Console\Commands\LicenseHeartbeatCommand;
use Modules\SystemLicenseGuard\Console\Commands\LicenseStatusCommand;
use Modules\SystemLicenseGuard\Http\Middleware\CheckLicenseMiddleware;
use Modules\SystemLicenseGuard\Http\Middleware\CheckModuleAccessMiddleware;
use Modules\SystemLicenseGuard\Services\CentralHubClientService;
use Modules\SystemLicenseGuard\Services\HardwareFingerprintService;
use Modules\SystemLicenseGuard\Services\LicenseVerifierService;

class SystemLicenseGuardServiceProvider extends ServiceProvider
{
    protected string $name = 'SystemLicenseGuard';
    protected string $nameLower = 'systemlicenseguard';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->mergeConfigFrom(
            module_path($this->name, 'config/license.php'),
            'license'
        );

        $this->app->singleton(HardwareFingerprintService::class, function () {
            return new HardwareFingerprintService();
        });

        $this->app->singleton(LicenseVerifierService::class, function ($app) {
            return new LicenseVerifierService(
                $app->make(HardwareFingerprintService::class)
            );
        });

        $this->app->singleton(CentralHubClientService::class, function ($app) {
            return new CentralHubClientService(
                $app->make(LicenseVerifierService::class),
                $app->make(HardwareFingerprintService::class)
            );
        });
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));

        if ($this->app->runningInConsole()) {
            $this->commands([
                LicenseStatusCommand::class,
                LicenseHeartbeatCommand::class,
            ]);

            $this->publishes([
                module_path($this->name, 'config/license.php') => config_path('license.php'),
            ], 'license-config');
        }

        // Register route middleware aliases
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('license.check', CheckLicenseMiddleware::class);
        $router->aliasMiddleware('module.access', CheckModuleAccessMiddleware::class);
    }
}
