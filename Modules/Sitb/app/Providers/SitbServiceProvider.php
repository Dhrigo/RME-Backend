<?php

namespace Modules\Sitb\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Modules\Sitb\Console\Commands\RetrySitbSubmissions;

class SitbServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'Sitb';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'sitb';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    protected array $commands = [
        RetrySitbSubmissions::class,
    ];

    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    /**
     * Define module schedules.
     *
     * @param $schedule
     */
    protected function configureSchedules(Schedule $schedule): void
    {
        $schedule->command(RetrySitbSubmissions::class)->everyFiveMinutes();
    }
}
