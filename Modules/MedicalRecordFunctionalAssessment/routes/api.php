<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordFunctionalAssessment\Http\Controllers\FunctionalAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('functional-assessments', FunctionalAssessmentController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['functional-assessments' => 'record']);
});
