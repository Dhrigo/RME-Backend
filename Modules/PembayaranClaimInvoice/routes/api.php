<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranClaimInvoice\Http\Controllers\ClaimInvoiceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('claim-invoices', ClaimInvoiceController::class)
        ->parameters(['claim-invoices' => 'claim_invoice']);
});
