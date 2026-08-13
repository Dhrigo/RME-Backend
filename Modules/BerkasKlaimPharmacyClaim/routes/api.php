<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimPharmacyClaim\Http\Controllers\PharmacyClaimController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-claims', PharmacyClaimController::class)->only(['index', 'store', 'show', 'update']);
});
