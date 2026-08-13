<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranInvoiceSubsidy\Http\Controllers\InvoiceSubsidyController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('invoice-subsidies', InvoiceSubsidyController::class)
        ->parameters(['invoice-subsidies' => 'invoice_subsidy']);
});
