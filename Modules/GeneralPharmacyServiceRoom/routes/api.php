<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPharmacyServiceRoom\Http\Controllers\PharmacyServiceRoomController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-service-rooms', PharmacyServiceRoomController::class);
});
