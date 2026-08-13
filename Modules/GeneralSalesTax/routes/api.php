<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralSalesTax\Http\Controllers\SalesTaxController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sales-taxes', SalesTaxController::class);
});
