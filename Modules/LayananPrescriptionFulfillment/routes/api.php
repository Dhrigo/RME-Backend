<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPrescriptionFulfillment\Http\Controllers\PrescriptionFulfillmentController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-fulfillments', PrescriptionFulfillmentController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['prescription-fulfillments' => 'record']);
});
