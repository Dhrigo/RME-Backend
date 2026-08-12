<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralRegion\Http\Controllers\RegionController;

Route::middleware(['auth:sanctum'])->prefix('v1/regions')->group(function () {
    Route::get('provinces', [RegionController::class, 'provinces']);
    Route::get('provinces/{province}/cities', [RegionController::class, 'cities']);
    Route::get('cities/{city}/districts', [RegionController::class, 'districts']);
    Route::get('districts/{district}/villages', [RegionController::class, 'villages']);
});
