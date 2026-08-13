<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordLabResultSummary\Http\Controllers\LabResultSummaryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-result-summaries', LabResultSummaryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['lab-result-summaries' => 'record']);
});
