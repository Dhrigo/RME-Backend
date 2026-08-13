<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPainScoreAssessment\Http\Controllers\PainScoreAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pain-score-assessments', PainScoreAssessmentController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['pain-score-assessments' => 'record']);
});
