<?php

namespace App\Modules\Support;

use Nwidart\Modules\Laravel\LaravelFileRepository;

class CachedFileRepository extends LaravelFileRepository
{
    /**
     * {@inheritdoc}
     */
    public function scan(): array
    {
        $cache = ModuleManifestCachePath::read();

        if ($cache === null) {
            return parent::scan();
        }

        $modules = [];

        foreach ($cache['modules'] as $key => $data) {
            $modules[$key] = $this->createModule($this->app, $data['name'], $data['module_directory']);
        }

        return $modules;
    }
}
