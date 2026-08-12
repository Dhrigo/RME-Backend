<?php

namespace App\Console\Commands;

use App\Modules\Support\ModuleManifestCachePath;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Contracts\ActivatorInterface;
use Nwidart\Modules\Json;

class ModuleManifestCache extends Command
{
    protected $signature = 'module:manifest-cache {--clear : Remove the cached manifest instead of building it}';

    protected $description = 'Build (or clear) the cached module manifest used to skip per-request module.json scanning';

    public function handle(ActivatorInterface $activator): int
    {
        if ($this->option('clear')) {
            $this->clear();

            return self::SUCCESS;
        }

        // Always start from a clean slate: a stale compiled provider list
        // (bootstrap/cache/{modules,services,packages}.php) referencing a module that no
        // longer exists will crash artisan itself before this command even runs again.
        $this->clear();

        $modulesRoot = config('modules.paths.modules');
        $manifests = glob($modulesRoot.'/*/module.json') ?: [];

        $modules = [];

        foreach ($manifests as $manifestPath) {
            $json = Json::make($manifestPath)->getAttributes();
            $name = $json['name'] ?? null;

            if ($name === null || ! $activator->hasStatus($name, true)) {
                continue;
            }

            $modules[strtolower($name)] = [
                'module_directory' => dirname($manifestPath),
                ...$json,
            ];
        }

        uasort($modules, fn ($a, $b) => ($a['priority'] ?? 0) <=> ($b['priority'] ?? 0));

        $export = var_export(['generated_at' => now()->toDateTimeString(), 'modules' => $modules], true);

        file_put_contents(ModuleManifestCachePath::path(), "<?php\n\nreturn {$export};\n");

        $this->info(sprintf('Module manifest cache written: %d enabled module(s) -> %s', count($modules), ModuleManifestCachePath::path()));

        return self::SUCCESS;
    }

    private function clear(): void
    {
        foreach ([ModuleManifestCachePath::path(), base_path('bootstrap/cache/modules.php'), base_path('bootstrap/cache/services.php')] as $file) {
            File::exists($file) && File::delete($file);
        }
    }
}
