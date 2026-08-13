<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralOtherServiceTariff\Http\Controllers\OtherServiceTariffController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('other-service-tariffs', OtherServiceTariffController::class);
});
