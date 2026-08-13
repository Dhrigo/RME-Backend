<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananCriticalLabValue\Http\Controllers\CriticalLabValueController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('critical-lab-values', CriticalLabValueController::class)->only(['index', 'store', 'show', 'update'])->parameters(['critical-lab-values' => 'critical_value']);
});
