<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranPackageInvoiceItem\Http\Controllers\PackageInvoiceItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('package-invoice-items', PackageInvoiceItemController::class)
        ->parameters(['package-invoice-items' => 'package_invoice_item']);
});
