<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordTbDiseaseHistory\Http\Controllers\TbDiseaseHistoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tb-disease-histories', TbDiseaseHistoryController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['tb-disease-histories' => 'record']);
});
