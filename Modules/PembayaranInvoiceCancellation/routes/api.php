<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranInvoiceCancellation\Http\Controllers\InvoiceCancellationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('invoice-cancellations', InvoiceCancellationController::class)->only(['index', 'store', 'show']);
});
