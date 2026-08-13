<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordBaepMotorDetail\Http\Controllers\BaepMotorDetailController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('baep-motor-details', BaepMotorDetailController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['baep-motor-details' => 'record']);
});
