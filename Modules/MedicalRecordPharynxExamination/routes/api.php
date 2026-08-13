<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordPharynxExamination\Http\Controllers\PharynxExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharynx-examinations', PharynxExaminationController::class)
        ->parameters(['pharynx-examinations' => 'record']);
});
