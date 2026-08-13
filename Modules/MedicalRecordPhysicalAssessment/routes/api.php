<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPhysicalAssessment\Http\Controllers\PhysicalAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('physical-assessments', PhysicalAssessmentController::class)
        ->parameters(['physical-assessments' => 'record']);
});
