<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranInvoiceItem\Http\Controllers\InvoiceItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('invoice-items', InvoiceItemController::class);
});
