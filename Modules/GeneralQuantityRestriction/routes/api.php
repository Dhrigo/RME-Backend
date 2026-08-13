<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralQuantityRestriction\Http\Controllers\QuantityRestrictionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('quantity-restrictions', QuantityRestrictionController::class);
});
