<?php

namespace App\Modules\Support;

use Illuminate\Support\Collection;
use Nwidart\Modules\ModuleManifest;

class CachedModuleManifest extends ModuleManifest
{
    /**
     * {@inheritdoc}
     */
    public function getModulesData(): Collection
    {
        $cache = ModuleManifestCachePath::read();

        if ($cache === null) {
            return parent::getModulesData();
        }

        return collect($cache['modules'])->values();
    }
}
