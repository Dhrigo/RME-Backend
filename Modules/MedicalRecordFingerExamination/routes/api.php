<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordFingerExamination\Http\Controllers\FingerExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('finger-examinations', FingerExaminationController::class)
        ->parameters(['finger-examinations' => 'record']);
});
