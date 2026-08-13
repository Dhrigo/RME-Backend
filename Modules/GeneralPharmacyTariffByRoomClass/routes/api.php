<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPharmacyTariffByRoomClass\Http\Controllers\PharmacyTariffByRoomClassController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-tariff-by-room-classes', PharmacyTariffByRoomClassController::class);
});
