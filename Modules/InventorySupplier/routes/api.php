<?php

use Illuminate\Support\Facades\Route;
use Modules\InventorySupplier\Http\Controllers\SupplierController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('suppliers', SupplierController::class);
});
