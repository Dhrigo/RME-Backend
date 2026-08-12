<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralServiceTariff\Http\Controllers\ServiceTariffController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('service-tariffs', ServiceTariffController::class);
});
