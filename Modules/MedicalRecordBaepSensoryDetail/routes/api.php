<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBaepSensoryDetail\Http\Controllers\BaepSensoryDetailController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('baep-sensory-details', BaepSensoryDetailController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['baep-sensory-details' => 'record']);
});
