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
     * nwidart's own register() calls registerProviders(), which registers its
     * Nwidart\Modules\Providers\ContractsServiceProvider - and THAT does a plain
     * `$this->app->bind(RepositoryInterface::class, LaravelFileRepository::class)`,
     * silently overwriting our cached singleton binding from registerServices() below.
     * The result: every module_path() call for the rest of the request/test (there are
     * several per module - registerTranslations, registerConfig, registerViews,
     * loadMigrationsFrom) resolves the plain uncached repository and does a full
     * glob-scan of every module.json, every single call. That's O(n) module_path()
     * calls each doing an O(n) scan - O(n^2) real filesystem I/O per boot, the actual
     * cause of this app's growing per-module test-suite cost (confirmed by
     * instrumentation: at 52 modules this silent bug alone cost ~30-40ms/module and
     * would have gotten quadratically worse toward the 675-module catalog target).
     * Re-asserting the binding here, after parent::register() has already run (and
     * been clobbered), guarantees it's correct again before boot() - and therefore
     * every module_path() call - runs.
     */
    public function register()
    {
        parent::register();
        $this->registerServices();
    }

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
