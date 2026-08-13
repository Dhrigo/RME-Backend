<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimRadiologyClaim\Http\Controllers\RadiologyClaimController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('radiology-claims', RadiologyClaimController::class)->only(['index', 'store', 'show', 'update']);
});
