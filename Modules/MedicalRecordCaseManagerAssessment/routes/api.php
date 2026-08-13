<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordCaseManagerAssessment\Http\Controllers\CaseManagerAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('case-manager-assessments', CaseManagerAssessmentController::class)
        ->parameters(['case-manager-assessments' => 'record']);
});
