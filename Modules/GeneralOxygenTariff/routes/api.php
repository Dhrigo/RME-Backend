<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralOxygenTariff\Http\Controllers\OxygenTariffController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('oxygen-tariffs', OxygenTariffController::class);
});
