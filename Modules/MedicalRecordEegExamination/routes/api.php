<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEegExamination\Http\Controllers\EegExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('eeg-examinations', EegExaminationController::class)
        ->parameters(['eeg-examinations' => 'record']);
});
