<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTonsilExamination\Http\Controllers\TonsilExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tonsil-examinations', TonsilExaminationController::class)
        ->parameters(['tonsil-examinations' => 'record']);
});
