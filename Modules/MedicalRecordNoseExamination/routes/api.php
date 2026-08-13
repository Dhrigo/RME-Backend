<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordNoseExamination\Http\Controllers\NoseExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('nose-examinations', NoseExaminationController::class)
        ->parameters(['nose-examinations' => 'record']);
});
