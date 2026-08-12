<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDischargeSummary\Http\Controllers\DischargeSummaryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discharge-summaries', DischargeSummaryController::class)->only(['index', 'store', 'show']);
});
