<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryItem\Http\Controllers\ItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('items', ItemController::class);
    Route::post('items/{item}/adjust-stock', [ItemController::class, 'adjustStock']);
});
