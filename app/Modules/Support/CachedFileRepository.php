<?php

namespace App\Modules\Support;

use Nwidart\Modules\Laravel\LaravelFileRepository;

class CachedFileRepository extends LaravelFileRepository
{
    /**
     * Per-instance memoization of the built Module object list.
     *
     * Parent FileRepository::scan() has a `!$this->app->runningUnitTests()` guard around its
     * own static cache, meaning it deliberately rebuilds the full module list from scratch on
     * every single call while running tests. Every module boot calls module_path() at least
     * once (via loadMigrationsFrom), which calls find() -> all() -> scan() - so with that guard
     * in play, N modules means N full rebuilds of N Module objects each: O(n^2) per boot, not
     * O(n). At 52 modules this alone was ~30-40ms/module of pure waste; it scales quadratically
     * so it would become catastrophic well before reaching the catalog's 675-module target.
     * This class's RepositoryInterface binding is a per-Application singleton, and the whole
     * Application is rebuilt fresh for every test anyway, so there is no staleness risk in
     * memoizing per-instance regardless of the test-running guard.
     */
    private ?array $moduleCache = null;

    /**
     * {@inheritdoc}
     */
    public function scan(): array
    {
        if ($this->moduleCache !== null) {
            return $this->moduleCache;
        }

        $cache = ModuleManifestCachePath::read();

        if ($cache === null) {
            return $this->moduleCache = parent::scan();
        }

        $modules = [];

        foreach ($cache['modules'] as $key => $data) {
            $modules[$key] = $this->createModule($this->app, $data['name'], $data['module_directory']);
        }

        return $this->moduleCache = $modules;
    }
}
