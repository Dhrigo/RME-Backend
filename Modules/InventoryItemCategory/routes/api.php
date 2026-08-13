<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryItemCategory\Http\Controllers\InventoryItemCategoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('inventoryitemcategories', InventoryItemCategoryController::class)->names('inventoryitemcategory');
});
