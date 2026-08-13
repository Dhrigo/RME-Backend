<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHeadExamination\Http\Controllers\HeadExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('head-examinations', HeadExaminationController::class)
        ->parameters(['head-examinations' => 'record']);
});
