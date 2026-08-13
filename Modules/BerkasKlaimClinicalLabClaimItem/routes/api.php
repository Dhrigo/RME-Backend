<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimClinicalLabClaimItem\Http\Controllers\ClinicalLabClaimItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('clinical-lab-claim-items', ClinicalLabClaimItemController::class)->only(['index', 'store', 'show']);
});
