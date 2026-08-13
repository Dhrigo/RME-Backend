<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPrescriptionFulfillmentItem\Http\Controllers\PrescriptionFulfillmentItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('prescription-fulfillment-items', PrescriptionFulfillmentItemController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['prescription-fulfillment-items' => 'record']);
});
