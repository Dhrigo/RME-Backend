<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordSkinPrickTestExamination\Http\Controllers\SkinPrickTestExaminationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('skin-prick-tests', SkinPrickTestExaminationController::class)
        ->parameters(['skin-prick-tests' => 'record']);
});
