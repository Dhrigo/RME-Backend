<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordMorseFallScaleAssessment\Http\Controllers\MorseFallScaleAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('morse-fall-scale-assessments', MorseFallScaleAssessmentController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['morse-fall-scale-assessments' => 'record']);
});
