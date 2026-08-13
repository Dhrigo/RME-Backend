<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordLabResultSummaryItem\Http\Controllers\LabResultSummaryItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-result-summary-items', LabResultSummaryItemController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['lab-result-summary-items' => 'record']);
});
