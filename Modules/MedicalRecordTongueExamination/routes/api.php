<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTongueExamination\Http\Controllers\TongueExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tongue-examinations', TongueExaminationController::class)
        ->parameters(['tongue-examinations' => 'record']);
});
