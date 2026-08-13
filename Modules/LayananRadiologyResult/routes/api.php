<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananRadiologyResult\Http\Controllers\RadiologyResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-results', RadiologyResultController::class)->only(['index', 'store', 'show', 'update'])->parameters(['radiology-results' => 'rad_result']);
});
