<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranInvoiceMerge\Http\Controllers\InvoiceMergeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('invoice-merges', InvoiceMergeController::class)
        ->parameters(['invoice-merges' => 'invoice_merge']);
});
