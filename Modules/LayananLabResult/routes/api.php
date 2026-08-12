<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabResult\Http\Controllers\LabResultController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-results', LabResultController::class)->only(['index', 'store', 'show']);
});
