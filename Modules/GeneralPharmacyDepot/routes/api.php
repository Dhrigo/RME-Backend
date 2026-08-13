<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPharmacyDepot\Http\Controllers\PharmacyDepotController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-depots', PharmacyDepotController::class)->parameters(['pharmacy-depots' => 'pharmacy_depot']);
});
