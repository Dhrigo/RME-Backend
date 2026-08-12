<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPrescriptionItem\Http\Controllers\PrescriptionItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-items', PrescriptionItemController::class)->only(['index', 'store', 'show']);
});
