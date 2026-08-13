<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBarthelIndexAssessment\Http\Controllers\BarthelIndexAssessmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('barthel-index-assessments', BarthelIndexAssessmentController::class)
        ->parameters(['barthel-index-assessments' => 'record']);
});
