<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordUpperGiTractExamination\Http\Controllers\UpperGiTractExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('upper-gi-examinations', UpperGiTractExaminationController::class)
        ->parameters(['upper-gi-examinations' => 'record']);
});
