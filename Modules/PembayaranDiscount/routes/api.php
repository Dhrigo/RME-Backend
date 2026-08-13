<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranDiscount\Http\Controllers\DiscountController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('discounts', DiscountController::class);
});
