<?php

namespace Modules\SatuSehat\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Modules\SatuSehat\Console\Commands\RetrySatuSehatSubmissions;

class SatuSehatServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'SatuSehat';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'satusehat';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    protected array $commands = [
        RetrySatuSehatSubmissions::class,
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
        $schedule->command(RetrySatuSehatSubmissions::class)->everyFiveMinutes();
    }
}
