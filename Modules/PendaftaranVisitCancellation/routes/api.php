<?php

use Illuminate\Support\Facades\Route;
use Modules\PendaftaranVisitCancellation\Http\Controllers\VisitCancellationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('visitcancellations', VisitCancellationController::class)->only(['index', 'store', 'show']);
});
