<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEyeExamination\Http\Controllers\EyeExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('eye-examinations', EyeExaminationController::class)
        ->parameters(['eye-examinations' => 'record']);
});
