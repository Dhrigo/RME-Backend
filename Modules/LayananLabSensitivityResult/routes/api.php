<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabSensitivityResult\Http\Controllers\LabSensitivityResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-sensitivity-results', LabSensitivityResultController::class)->only(['index', 'store', 'show'])->parameters(['lab-sensitivity-results' => 'sensitivity_result']);
});
