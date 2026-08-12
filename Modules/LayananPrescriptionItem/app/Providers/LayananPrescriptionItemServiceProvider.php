<?php

namespace Modules\LayananPrescriptionItem\Providers;

use Nwidart\Modules\Support\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class LayananPrescriptionItemServiceProvider extends ModuleServiceProvider
{
    /**
     * The name of the module.
     */
    protected string $name = 'LayananPrescriptionItem';

    /**
     * The lowercase version of the module name.
     */
    protected string $nameLower = 'layananprescriptionitem';

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    // protected array $commands = [];

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
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }
}
