<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranRegistrationInvoice\Http\Controllers\RegistrationInvoiceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('registration-invoices', RegistrationInvoiceController::class)
        ->parameters(['registration-invoices' => 'registration_invoice']);
});
