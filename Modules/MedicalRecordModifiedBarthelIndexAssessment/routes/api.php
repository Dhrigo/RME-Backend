<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordModifiedBarthelIndexAssessment\Http\Controllers\ModifiedBarthelIndexAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('modified-barthel-index-assessments', ModifiedBarthelIndexAssessmentController::class)
        ->parameters(['modified-barthel-index-assessments' => 'record']);
});
