<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryGoodsReceiptCancellation\Http\Controllers\InventoryGoodsReceiptCancellationController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('goods-receipt-cancellations', InventoryGoodsReceiptCancellationController::class)
        ->parameters(['goods-receipt-cancellations' => 'cancellation'])
        ->only(['index', 'store', 'show']);
});
