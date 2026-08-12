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
            // Do NOT memoize this branch: it means the manifest hasn't been warmed
            // (e.g. mid module:make-submodule, where a module gets created on disk
            // partway through this very process). Memoizing here would freeze the
            // module list from before the new module existed, and every later
            // module_path()/findOrFail() call in the same process (nwidart's own
            // internal make-seed/make-provider chaining included) would 404 on a
            // module that's actually already on disk. Falls through to parent::scan(),
            // which does its own live glob (cheap here since this path is only hit
            // without a warm manifest, i.e. local dev/scaffolding, not hot request paths).
            // Parent::scan() also has its own private static self::$modules cache that
            // (outside of tests) survives across calls in this same process regardless of
            // filesystem changes in between - reset it first so a module created earlier
            // in this process (e.g. by module:make, one step before it needs to find that
            // very module again for make-seed/make-provider) is actually picked up by the
            // live glob below instead of an empty/stale snapshot from before it existed.
            $this->resetModules();

            return parent::scan();
        }

        $modules = [];

        foreach ($cache['modules'] as $key => $data) {
            $modules[$key] = $this->createModule($this->app, $data['name'], $data['module_directory']);
        }

        return $this->moduleCache = $modules;
    }
}
