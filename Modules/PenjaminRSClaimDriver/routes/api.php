<?php

use Illuminate\Support\Facades\Route;
use Modules\PenjaminRSClaimDriver\Http\Controllers\PenjaminRSClaimDriverController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('claim-drivers', PenjaminRSClaimDriverController::class)
        ->parameters(['claim-drivers' => 'claim_driver']);
});
