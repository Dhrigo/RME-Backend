<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananRadiologyViewerLog\Http\Controllers\RadiologyViewerLogController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-viewer-logs', RadiologyViewerLogController::class)->only(['index', 'store', 'show', 'destroy'])->parameters(['radiology-viewer-logs' => 'record']);
});
