<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHumptyDumptyFallScaleAssessment\Http\Controllers\HumptyDumptyFallScaleAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('humpty-dumpty-fall-scale-assessments', HumptyDumptyFallScaleAssessmentController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['humpty-dumpty-fall-scale-assessments' => 'record']);
});
