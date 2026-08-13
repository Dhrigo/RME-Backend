<?php

use Illuminate\Support\Facades\Route;
use Modules\MedicalRecordAnesthesiaPreparation\Http\Controllers\AnesthesiaPreparationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('anesthesia-preparations', AnesthesiaPreparationController::class)
        ->only(['index', 'store', 'show'])
        ->parameters(['anesthesia-preparations' => 'record']);
});
