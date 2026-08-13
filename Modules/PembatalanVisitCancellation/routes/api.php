<?php

use Illuminate\Support\Facades\Route;
use Modules\PembatalanVisitCancellation\Http\Controllers\VisitCancellationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pembatalan-visit-cancellations', VisitCancellationController::class)->only(['index', 'store', 'show'])->parameters(['pembatalan-visit-cancellations' => 'visit_cancellation']);
});
