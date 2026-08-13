<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordLowerLegExamination\Http\Controllers\LowerLegExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lower-leg-examinations', LowerLegExaminationController::class)
        ->parameters(['lower-leg-examinations' => 'record']);
});
