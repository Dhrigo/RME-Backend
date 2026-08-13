<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralAdministrationTariff\Http\Controllers\AdministrationTariffController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('administration-tariffs', AdministrationTariffController::class);
});
