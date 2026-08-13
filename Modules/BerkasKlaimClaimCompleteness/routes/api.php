<?php

use Illuminate\Support\Facades\Route;
use Modules\BerkasKlaimClaimCompleteness\Http\Controllers\BerkasKlaimClaimCompletenessController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('claim-completeness', BerkasKlaimClaimCompletenessController::class)
        ->parameters(['claim-completeness' => 'claim_completeness']);
});
