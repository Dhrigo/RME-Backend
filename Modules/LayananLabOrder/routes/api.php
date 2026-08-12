<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLabOrder\Http\Controllers\LabOrderController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lab-orders', LabOrderController::class)->only(['index', 'store', 'show', 'update']);
});
