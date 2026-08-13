<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimPathologyClaimItem\Http\Controllers\PathologyClaimItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pathology-claim-items', PathologyClaimItemController::class)->only(['index', 'store', 'show']);
});
