<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNeckExamination\Http\Controllers\NeckExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('neck-examinations', NeckExaminationController::class)
        ->parameters(['neck-examinations' => 'record']);
});
