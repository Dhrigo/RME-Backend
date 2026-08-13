<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAnalExamination\Http\Controllers\AnalExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('anal-examinations', AnalExaminationController::class)
        ->parameters(['anal-examinations' => 'record']);
});
