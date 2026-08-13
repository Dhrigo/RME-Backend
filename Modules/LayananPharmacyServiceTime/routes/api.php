<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananPharmacyServiceTime\Http\Controllers\PharmacyServiceTimeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-service-times', PharmacyServiceTimeController::class)->only(['index', 'store', 'show', 'update', 'destroy'])->parameters(['pharmacy-service-times' => 'record']);
});
