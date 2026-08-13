<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHandJointExamination\Http\Controllers\HandJointExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('hand-joint-examinations', HandJointExaminationController::class)
        ->parameters(['hand-joint-examinations' => 'record']);
});
