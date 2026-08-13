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
     * Set by resetModules() when something in this process (e.g. ModuleGenerator creating a
     * new module) explicitly signals the on-disk module list changed. Once set, scan() must
     * not trust the (now stale-by-definition) file cache anymore for the rest of the process -
     * only a live glob reflects the change.
     */
    private bool $forceLiveScan = false;

    /**
     * {@inheritdoc}
     */
    public function scan(): array
    {
        if ($this->moduleCache !== null) {
            return $this->moduleCache;
        }

        if ($this->forceLiveScan) {
            return $this->moduleCache = parent::scan();
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

    /**
     * ModuleGenerator::generate() calls this mid-creation (after writing module.json/files,
     * before generating seeders/providers/etc that need to resolve the just-created module by
     * name) specifically to invalidate any cached module list. Parent only resets its own
     * static self::$modules; without also clearing our instance-level $moduleCache here, scan()
     * above keeps serving the pre-creation snapshot for the rest of the process and every
     * subsequent lookup of the new module 404s. Clearing moduleCache alone isn't enough either -
     * the next scan() would just reload the same stale on-disk manifest cache file - so this
     * also flips forceLiveScan to bypass that file for the remainder of the process.
     */
    public function resetModules(): static
    {
        parent::resetModules();
        $this->moduleCache = null;
        $this->forceLiveScan = true;

        return $this;
    }
}
