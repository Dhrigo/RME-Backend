<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordFingernailExamination\Http\Controllers\FingernailExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('fingernail-examinations', FingernailExaminationController::class)
        ->parameters(['fingernail-examinations' => 'record']);
});
