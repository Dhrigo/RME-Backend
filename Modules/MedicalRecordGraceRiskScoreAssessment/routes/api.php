<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordGraceRiskScoreAssessment\Http\Controllers\GraceRiskScoreAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('grace-risk-score-assessments', GraceRiskScoreAssessmentController::class)
        ->parameters(['grace-risk-score-assessments' => 'record']);
});
