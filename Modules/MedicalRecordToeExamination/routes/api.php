<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordToeExamination\Http\Controllers\ToeExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('toe-examinations', ToeExaminationController::class)
        ->parameters(['toe-examinations' => 'record']);
});
