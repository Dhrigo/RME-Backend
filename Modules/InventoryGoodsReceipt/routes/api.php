<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryGoodsReceipt\Http\Controllers\GoodsReceiptController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('goods-receipts', GoodsReceiptController::class)->only(['index', 'store', 'show']);
});
