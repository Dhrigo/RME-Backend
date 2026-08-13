<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPhysicalExamination\Http\Controllers\PhysicalExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('physical-examinations', PhysicalExaminationController::class)
        ->parameters(['physical-examinations' => 'record']);
});
