<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimPathologyClaim\Http\Controllers\PathologyClaimController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pathology-claims', PathologyClaimController::class)->only(['index', 'store', 'show', 'update']);
});
