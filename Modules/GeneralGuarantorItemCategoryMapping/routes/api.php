<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralGuarantorItemCategoryMapping\Http\Controllers\GuarantorItemCategoryMappingController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('guarantor-item-category-mappings', GuarantorItemCategoryMappingController::class);
});
