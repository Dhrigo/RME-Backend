<?php

namespace App\Providers;

use App\Modules\Support\CachedFileRepository;
use App\Modules\Support\CachedModuleManifest;
use Illuminate\Filesystem\Filesystem;
use Nwidart\Modules\Contracts\ActivatorInterface;
use Nwidart\Modules\Contracts\RepositoryInterface;
use Nwidart\Modules\Exceptions\InvalidActivatorClass;
use Nwidart\Modules\LaravelModulesServiceProvider;
use Nwidart\Modules\ModuleManifest;

/**
 * Replaces nwidart's default service bindings with cache-aware versions that skip the
 * module.json glob scan on every request once bootstrap/cache/module-manifest.php has
 * been warmed via `php artisan module:manifest-cache`. Falls back to nwidart's normal
 * (uncached) behavior when the cache file is absent, e.g. local dev right after a module
 * is created/removed.
 */
class CachedLaravelModulesServiceProvider extends LaravelModulesServiceProvider
{
    /**
     * {@inheritdoc}
     */
    protected function registerServices()
    {
        $this->app->singleton(RepositoryInterface::class, function ($app) {
            $path = $app['config']->get('modules.paths.modules');

            return new CachedFileRepository($app, $path);
        });

        $this->app->singleton(ActivatorInterface::class, function ($app) {
            $activator = $app['config']->get('modules.activator');
            $class = $app['config']->get('modules.activators.'.$activator)['class'];

            if ($class === null) {
                throw InvalidActivatorClass::missingConfig();
            }

            return new $class($app);
        });

        $this->app->alias(RepositoryInterface::class, 'modules');

        $this->app->singleton(
            ModuleManifest::class,
            fn () => new CachedModuleManifest(
                new Filesystem,
                app(RepositoryInterface::class)->getScanPaths(),
                $this->getCachedModulePath(),
                app(ActivatorInterface::class)
            )
        );
    }
}
