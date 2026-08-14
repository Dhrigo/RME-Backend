<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatMasterData\Http\Controllers\MasterDataController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/master-data')->group(function () {
    Route::get('provinces', [MasterDataController::class, 'provinces']);
    Route::get('cities', [MasterDataController::class, 'cities']);
    Route::get('districts', [MasterDataController::class, 'districts']);
    Route::get('sub-districts', [MasterDataController::class, 'subDistricts']);
    Route::get('sarana', [MasterDataController::class, 'sarana']);
    Route::get('kfa/products', [MasterDataController::class, 'kfaProduct']);
    Route::get('kfa/products/all', [MasterDataController::class, 'kfaProductsAll']);
});
