<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPalateExamination\Http\Controllers\PalateExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('palate-examinations', PalateExaminationController::class)
        ->parameters(['palate-examinations' => 'record']);
});
