<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryGoodsReceipt\Http\Controllers\InventoryGoodsReceiptController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('inventorygoodsreceipts', InventoryGoodsReceiptController::class)->names('inventorygoodsreceipt');
});
