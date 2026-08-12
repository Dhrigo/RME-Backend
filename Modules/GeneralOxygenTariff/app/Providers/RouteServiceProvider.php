<?php

namespace Modules\GeneralOxygenTariff\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')->prefix('api')->group(module_path('GeneralOxygenTariff', '/routes/api.php'));
        });
    }
}
