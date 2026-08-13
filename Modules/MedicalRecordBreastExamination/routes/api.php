<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBreastExamination\Http\Controllers\BreastExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('breast-examinations', BreastExaminationController::class)
        ->parameters(['breast-examinations' => 'record']);
});
