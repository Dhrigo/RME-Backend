<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordChestExamination\Http\Controllers\ChestExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('chest-examinations', ChestExaminationController::class)
        ->parameters(['chest-examinations' => 'record']);
});
