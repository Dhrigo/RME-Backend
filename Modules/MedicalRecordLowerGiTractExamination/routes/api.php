<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordLowerGiTractExamination\Http\Controllers\LowerGiTractExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lower-gi-examinations', LowerGiTractExaminationController::class)
        ->parameters(['lower-gi-examinations' => 'record']);
});
