<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordGenitalExamination\Http\Controllers\GenitalExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('genital-examinations', GenitalExaminationController::class)
        ->parameters(['genital-examinations' => 'record']);
});
