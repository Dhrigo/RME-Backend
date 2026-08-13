<?php

use Illuminate\Support\Facades\Route;
use Modules\GeneralPharmacyGuarantorMargin\Http\Controllers\PharmacyGuarantorMarginController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pharmacy-guarantor-margins', PharmacyGuarantorMarginController::class);
});
