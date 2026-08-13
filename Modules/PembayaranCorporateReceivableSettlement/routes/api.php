<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranCorporateReceivableSettlement\Http\Controllers\CorporateReceivableSettlementController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('corporate-receivable-settlements', CorporateReceivableSettlementController::class)->only(['index', 'store', 'show']);
});
