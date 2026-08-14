<?php

use Illuminate\Support\Facades\Route;
use Modules\SatuSehatKptl\Http\Controllers\KptlController;

Route::middleware(['auth:sanctum'])->prefix('v1/satusehat/kptl')->group(function () {
    Route::post('code', [KptlController::class, 'code']);
    Route::post('base-code', [KptlController::class, 'baseCode']);
    Route::post('base-code-combination', [KptlController::class, 'baseCodeCombination']);
    Route::post('modifier', [KptlController::class, 'modifier']);
    Route::post('modifier-value', [KptlController::class, 'modifierValue']);
    Route::post('base-code-by-modifier', [KptlController::class, 'baseCodeByModifier']);
});
