<?php

use Illuminate\Support\Facades\Route;
use Modules\InventorySupplier\Http\Controllers\InventorySupplierController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('inventorysuppliers', InventorySupplierController::class)->names('inventorysupplier');
});
