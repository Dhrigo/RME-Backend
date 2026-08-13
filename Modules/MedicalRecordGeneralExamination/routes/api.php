<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordGeneralExamination\Http\Controllers\GeneralExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('general-examinations', GeneralExaminationController::class)
        ->parameters(['general-examinations' => 'record']);
});
