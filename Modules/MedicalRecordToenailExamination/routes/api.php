<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordToenailExamination\Http\Controllers\ToenailExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('toenail-examinations', ToenailExaminationController::class)
        ->parameters(['toenail-examinations' => 'record']);
});
