<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordMchatAssessmentExamination\Http\Controllers\MchatAssessmentExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('mchat-assessment-examinations', MchatAssessmentExaminationController::class)
        ->parameters(['mchat-assessment-examinations' => 'record']);
});
