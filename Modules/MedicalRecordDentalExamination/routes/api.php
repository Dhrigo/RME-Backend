<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordDentalExamination\Http\Controllers\DentalExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('dental-examinations', DentalExaminationController::class)
        ->parameters(['dental-examinations' => 'record']);
});
