<?php

use Illuminate\Support\Facades\Route;
use Modules\LayananLeftoverMedicationVoucher\Http\Controllers\LeftoverMedicationVoucherController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('leftover-medication-vouchers', LeftoverMedicationVoucherController::class)->only(['index', 'store', 'show', 'update'])->parameters(['leftover-medication-vouchers' => 'voucher']);
});
