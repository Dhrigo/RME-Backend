<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordUpperArmExamination\Http\Controllers\UpperArmExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('upper-arm-examinations', UpperArmExaminationController::class)
        ->parameters(['upper-arm-examinations' => 'record']);
});
