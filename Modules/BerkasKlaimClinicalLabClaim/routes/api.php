<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimClinicalLabClaim\Http\Controllers\ClinicalLabClaimController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('clinical-lab-claims', ClinicalLabClaimController::class)->only(['index', 'store', 'show', 'update']);
});
