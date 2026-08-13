<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRegionType\Http\Controllers\RegionTypeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('region-types', RegionTypeController::class);
});
