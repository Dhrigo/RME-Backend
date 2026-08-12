<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralServiceTariffDistribution\Http\Controllers\ServiceTariffDistributionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('service-tariff-distributions', ServiceTariffDistributionController::class);
});
