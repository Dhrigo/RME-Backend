<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranInvoiceGuarantor\Http\Controllers\InvoiceGuarantorController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('invoice-guarantors', InvoiceGuarantorController::class)
        ->parameters(['invoice-guarantors' => 'invoice_guarantor']);
});
