<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryStockRequest\Http\Controllers\InventoryStockRequestController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('inventorystockrequests', InventoryStockRequestController::class)->names('inventorystockrequest');
});
