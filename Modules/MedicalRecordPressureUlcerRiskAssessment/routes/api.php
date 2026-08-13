<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPressureUlcerRiskAssessment\Http\Controllers\PressureUlcerRiskAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pressure-ulcer-risk-assessments', PressureUlcerRiskAssessmentController::class)
        ->parameters(['pressure-ulcer-risk-assessments' => 'record']);
});
