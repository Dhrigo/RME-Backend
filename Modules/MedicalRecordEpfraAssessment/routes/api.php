<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEpfraAssessment\Http\Controllers\EpfraAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('epfra-assessments', EpfraAssessmentController::class)
        ->parameters(['epfra-assessments' => 'record']);
});
