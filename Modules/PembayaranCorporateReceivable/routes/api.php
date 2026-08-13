<?php

use Illuminate\Support\Facades\Route;
use Modules\PembayaranCorporateReceivable\Http\Controllers\CorporateReceivableController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('corporate-receivables', CorporateReceivableController::class)->only(['index', 'store', 'show', 'update']);
});
