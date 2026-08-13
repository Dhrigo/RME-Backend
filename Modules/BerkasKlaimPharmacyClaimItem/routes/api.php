<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimPharmacyClaimItem\Http\Controllers\PharmacyClaimItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-claim-items', PharmacyClaimItemController::class)->only(['index', 'store', 'show']);
});
