<?php

namespace App\Modules\Support;

class ModuleManifestCachePath
{
    public static function path(): string
    {
        return base_path('bootstrap/cache/module-manifest.php');
    }

    /**
     * Read the cached module manifest, or null if it hasn't been warmed.
     */
    public static function read(): ?array
    {
        $path = static::path();

        if (! is_file($path)) {
            return null;
        }

        return require $path;
    }
}
