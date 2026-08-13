<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPathologyAnatomyResult\Http\Controllers\PathologyAnatomyResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pathology-anatomy-results', PathologyAnatomyResultController::class)->only(['index', 'store', 'show', 'update'])->parameters(['pathology-anatomy-results' => 'pa_result']);
});
