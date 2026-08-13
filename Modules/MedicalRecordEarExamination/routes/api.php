<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordEarExamination\Http\Controllers\EarExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('ear-examinations', EarExaminationController::class)
        ->parameters(['ear-examinations' => 'record']);
});
