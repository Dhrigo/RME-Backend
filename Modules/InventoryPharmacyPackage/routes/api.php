<?php

use Illuminate\Support\Facades\Route;
use Modules\InventoryPharmacyPackage\Http\Controllers\InventoryPharmacyPackageController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-packages', InventoryPharmacyPackageController::class)
        ->parameters(['pharmacy-packages' => 'pharmacy_package']);
});
