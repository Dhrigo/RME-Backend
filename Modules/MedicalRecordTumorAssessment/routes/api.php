<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTumorAssessment\Http\Controllers\TumorAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tumor-assessments', TumorAssessmentController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['tumor-assessments' => 'record']);
});
