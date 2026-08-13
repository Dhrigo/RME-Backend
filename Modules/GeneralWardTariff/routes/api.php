<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralWardTariff\Http\Controllers\WardTariffController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ward-tariffs', WardTariffController::class);
});
