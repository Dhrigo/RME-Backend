<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLeftoverMedicationVoucherItem\Http\Controllers\LeftoverMedicationVoucherItemController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('leftover-medication-voucher-items', LeftoverMedicationVoucherItemController::class)->only(['index', 'store', 'show'])->parameters(['leftover-medication-voucher-items' => 'voucher_item']);
});
