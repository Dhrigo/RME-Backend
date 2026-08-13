<?php

use Illuminate\Support\Facades\Route;
use Modules\PenjaminRSDrivers\Http\Controllers\PenjaminRSDriversController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('penjaminrsdrivers', PenjaminRSDriversController::class)->names('penjaminrsdrivers');
});
