<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordGetUpAndGoTestAssessment\Http\Controllers\GetUpAndGoTestAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('get-up-and-go-assessments', GetUpAndGoTestAssessmentController::class)
        ->parameters(['get-up-and-go-assessments' => 'record']);
});
