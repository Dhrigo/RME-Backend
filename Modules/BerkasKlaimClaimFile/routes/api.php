<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimClaimFile\Http\Controllers\BerkasKlaimClaimFileController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('claim-files', BerkasKlaimClaimFileController::class)
        ->parameters(['claim-files' => 'claim_file']);
});
