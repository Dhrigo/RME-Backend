<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordRadiologyResultSummary\Http\Controllers\RadiologyResultSummaryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-result-summaries', RadiologyResultSummaryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['radiology-result-summaries' => 'record']);
});
