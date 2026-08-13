<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEmgExamination\Http\Controllers\EmgExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('emg-examinations', EmgExaminationController::class)
        ->parameters(['emg-examinations' => 'record']);
});
