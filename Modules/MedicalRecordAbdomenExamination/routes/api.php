<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAbdomenExamination\Http\Controllers\AbdomenExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('abdomen-examinations', AbdomenExaminationController::class)
        ->parameters(['abdomen-examinations' => 'record']);
});
