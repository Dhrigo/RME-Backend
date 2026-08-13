<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordHairExamination\Http\Controllers\HairExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('hair-examinations', HairExaminationController::class)
        ->parameters(['hair-examinations' => 'record']);
});
